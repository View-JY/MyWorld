<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleZan;
use App\Models\ArticleCollect;
use App\Models\Category;
use App\Models\Comment;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ArticlesRequest;
use Auth;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * 文章权限设置
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('articles.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Article $article)
    {
        // 查找所有文章分类
        $categories = Category::all();

        return view('articles.create_and_edit', compact('categories', 'article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticlesRequest $request, ImageUploadHandler $uploader, Article $article)
    {
      // 处理数据
      $article->fill($request->all());
      // 当前用户ID
      $article->user_id = Auth::id();
      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($request->cover, 'cover', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $article ->cover = $result['path'];
        }
      }
      // 保存到数据库
      $article->save();
      // 页面跳转并返回信息
      return redirect() ->route('articles.show', $article->id)->with('message', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {
      // 按时间排序 - 默认按时间倒序
      $time_ordeyBy = 'desc';
      $comments = [];

      // 各种筛选
      if ( $request ->method() == 'GET' ) {
        $time_ordeyBy = $request ->order_by;

        // 获取全部评论
        $comments = $article ->comment() ->recent($time_ordeyBy) ->get();

        // 是否只看作者
        if ( $request ->look == 'author'  ) {
          $comments = $article ->comment() ->recent($time_ordeyBy) ->look($article ->user_id) ->get();
        } else if ( $request ->look == 'none' ) {
          $comments = [];
        }
      }

      return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // 编辑文章权限修改
        $this ->authorize('update', $article);
        // 获取全部分类
        $categories = Category::all();

        return view('articles.create_and_edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticlesRequest $request, ImageUploadHandler $uploader, Article $article)
    {
      // 更新文章权限修改
      $this ->authorize('update', $article);
      // 处理数据
      $article->fill($request->all());
      // 当前用户ID
      $article->user_id = Auth::id();
      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($request->cover, 'cover', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $article ->cover = $result['path'];
        }
      }
      // 保存到数据库
      $article->update();

      return redirect() ->route('articles.show', $article ->id) ->with('success', '更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    /**
     * 上传图片
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success'   => false,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }

    // 赞文章
    public function articleZan($id)
    {
      // 获取对应文章
      $article = Article::find($id);
      // 所需参数
      $params = [
          'user_id'  => Auth::id(),
          'article_id' => $article ->id
      ];
      // 确保一个人只能赞一次
      ArticleZan::firstOrCreate($params);

      return back() ->with('success', '点赞成功');
    }

    // 取消赞文章
    public function unArticleZan($id)
    {
      // 获取对应文章
      $article = Article::find($id);
      $article ->articleZan(Auth::id()) ->delete();

      return back() ->with('success', '取消点赞成功');
    }

    // 收藏文章
    public function articleCollect($id)
    {
      // 获取对应文章
      $article = Article::find($id);
      // 所需参数
      $params = [
          'user_id'  => Auth::id(),
          'article_id' => $article ->id
      ];
      // 确保一个人只能赞一次
      ArticleCollect::firstOrCreate($params);

      return back() ->with('success', '收藏成功');
    }

    // 取收藏文章
    public function unArticleCollect($id)
    {
      // 获取对应文章
      $article = Article::find($id);
      $article ->articleCollect(Auth::id()) ->delete();

      return back() ->with('success', '取消收藏成功');
    }
}
