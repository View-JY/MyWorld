<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\ArticlesRequest;
use App\Models\Article;
use App\Models\ArticleCollect;
use App\Models\ArticleTag;
use App\Models\ArticleZan;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Link;
use App\Models\Tag;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class ArticlesController extends Controller {
	/**
	 * 文章权限设置
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function home() {
		return view('articles.home');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('articles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Article $article) {
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
	public function store(ArticlesRequest $request, ImageUploadHandler $uploader, Article $article) {
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
				$article->cover = $result['path'];
			}
		}

		// 文章保存到数据库
		$article->save();

		// 然后再存储标签
		if ($request->has('tags')) {
			$this->tagStore($article->id, $request->tags);
		}

		// 页面跳转并返回信息
		return redirect()->route('articles.show', $article->id)->with('success', '文章创建成功.');
	}

	public function tagStore($articleId, $tagNameString) {
		if ($tagNameString == "") {
			return false;
		}

		$tagNameList = array_unique(explode(';', trim($tagNameString, ';')));

		if (!$tagNameList) {
			return false;
		}

		foreach ($tagNameList as $tagName) {
			$tagData = $this->findName($tagName);
			$create = [];
			$create['tag_id'] = count($tagData) > 0 ? $tagData['id'] : Tag::create(['tag_name' => $tagName])->id;
			$create['article_id'] = $articleId;
			ArticleTag::create($create);
		}

		return true;
	}

	public function findName($tagName) {
		$tag = Tag::where('tag_name', $tagName)->get();
		$data = [];
		if (!$tag->isEmpty()) {
			$tempData = $tag->toArray();
			$data = $tempData[0];
		}

		return $data;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Article  $article
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id, User $user, Link $link) {

		// 访问量统计
		\Visitor::log($id);

		$article = Article::with('user', 'comment', 'tag', 'articleCollects')->withCount(['articleZans as articleZans_count', 'comment as acomment_count', 'visitors as visitors_count', 'articleCollects as articleCollects_count'])->find($id);

		// 按时间排序 - 默认按时间倒序
		$time_ordeyBy = 'desc';
		$comments = $article->comment()->recent($time_ordeyBy)->get();

		// 各种筛选
		if ($request->method() == 'GET') {
			$time_ordeyBy = $request->order_by;

			// 是否只看作者
			if ($request->look == 'author') {
				$comments = $article->comment()->recent($time_ordeyBy)->look($article->user_id)->get();
			} else if ($request->look == 'none') {
				$comments = [];
			}
		}

		$type_id = $article->category->id;

		// 当前用户的相关类型文章
		$type_articles = $article->withCount(['articleZans as articleZans_count', 'comment as acomment_count'])->where('category_id', $type_id)->paginate(5);

		// 活跃用户
		$active_users = $user->getActiveUsers();

		// 资源推荐
		$links = $link->getAllCached();

		// 获取所有标签（标签云）
		$tags = Tag::with('article')->paginate(10);

		return view('articles.show', compact('article', 'type_articles', 'active_users', 'links', 'tags', 'userinfo', 'comments'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Article  $article
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Article $article) {
		// 编辑文章权限修改
		$this->authorize('update', $article);
		// 获取全部分类
		$categories = Category::all();

		// 标签相关
		$tags = $article->articleTag;
		$tagIdList = $this->tagsIdList($tags, false);

		// 获取标签文字
		$tagNames = $this->tagNameList($tagIdList);

		return view('articles.create_and_edit', compact('article', 'categories', 'tagNames'));
	}

	public function tagNameList($idList) {
		$tagName = "";

		if ($idList != "") {
			$tags = Tag::whereIn('id', explode(',', $idList))->get();

			if ($tags) {
				foreach ($tags as $tag) {
					$tagName .= $tag->tag_name . ";";
				}
			}
		}

		return $tagName;
	}

	private function tagsIdList($tags, $type = true) {
		$tagIdList = [];
		foreach ($tags as $tag) {
			$tagIdList[] = $tag->tag_id;
		}

		return $type ? $tagIdList : implode(',', $tagIdList);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Article  $article
	 * @return \Illuminate\Http\Response
	 */
	public function update(ArticlesRequest $request, ImageUploadHandler $uploader, Article $article) {
		// 更新文章权限修改
		$this->authorize('update', $article);
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
				$article->cover = $result['path'];
			}
		}
		// 保存到数据库
		$article->update();

		$this->updateArticleTags($article->id, $request->tags);

		return redirect()->route('articles.show', $article->id)->with('success', '更新成功！');
	}

	private function updateArticleTags($articleId, $tagNameString) {
		ArticleTag::where('article_id', $articleId)->delete();

		return $this->tagStore($articleId, $tagNameString);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Article  $article
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$article = Article::find($id);

		DB::transaction(function () use ($article) {
			$article->delete();
			$article->comment()->delete();
		}, 5);

		return redirect('/')->with('success', '文章删除成功');
	}

	/**
	 * 上传图片
	 */
	public function uploadImage(Request $request, ImageUploadHandler $uploader) {
		// 初始化返回数据，默认是失败的
		$data = [
			'success' => false,
			'msg' => '上传失败!',
			'file_path' => '',
		];
		// 判断是否有上传文件，并赋值给 $file
		if ($file = $request->upload_file) {
			// 保存图片到本地
			$result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
			// 图片保存成功的话
			if ($result) {
				$data['file_path'] = $result['path'];
				$data['msg'] = "上传成功!";
				$data['success'] = true;
			}
		}
		return $data;
	}

	// 赞文章
	public function articleZan($id) {
		// 获取对应文章
		$article = Article::find($id);
		// 所需参数
		$params = [
			'user_id' => Auth::id(),
			'article_id' => $article->id,
		];
		// 确保一个人只能赞一次
		ArticleZan::firstOrCreate($params);

		return back()->with('success', '点赞成功');
	}

	// 取消赞文章
	public function unArticleZan($id) {
		// 获取对应文章
		$article = Article::find($id);
		$article->articleZan(Auth::id())->delete();

		return back()->with('success', '取消点赞成功');
	}

	// 收藏文章
	public function articleCollect($id) {
		// 获取对应文章
		$article = Article::find($id);
		// 所需参数
		$params = [
			'user_id' => Auth::id(),
			'article_id' => $article->id,
		];
		// 确保一个人只能赞一次
		ArticleCollect::firstOrCreate($params);

		return back()->with('success', '收藏成功');
	}

	// 取收藏文章
	public function unArticleCollect($id) {
		// 获取对应文章
		$article = Article::find($id);
		$article->articleCollect(Auth::id())->delete();

		return back()->with('success', '取消收藏成功');
	}
}
