<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Category;
use App\Models\CategoryKeep;
use App\Models\ArticleZan;
use App\User;
use App\Models\Follower;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 返回全部专题
        $categories = Category::paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::with('article') ->withCount('article as article_count') ->find($id);

      return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    // 赞文章
    public function categoryKeep($id)
    {
      // 获取对应文章
      $category = Category::find($id);
      // 所需参数
      $params = [
          'user_id'  => Auth::id(),
          'category_id' => $category ->id
      ];
      // 确保一个人只能赞一次
      CategoryKeep::firstOrCreate($params);

      return back() ->with('success', '关注分类成功');
    }

    // 取消赞文章
    public function unCategoryKeep($id)
    {
      // 获取对应文章
      $category = Category::find($id);
      $category ->categoryKeep(Auth::id()) ->delete();

      return back() ->with('success', '取消关注分类成功');
    }

    public function allKeep($id = null)
    {
      // 当前用户
      $user = Auth::user();

      // 默认没有用户
      if ( empty($id) ) {
        $articleZans = ArticleZan::all();
        return view('categories.allKeep', compact('user', 'articleZans'));
      }

      // 点击获取用户
      $auth = User::find($id);
      // 所有喜欢
      $categoryKeeps = CategoryKeep::orderBy('created_at', 'desc') ->get();

      return view('categories.allKeep', compact('user', 'auth'));
    }
}
