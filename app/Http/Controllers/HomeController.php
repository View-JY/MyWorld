<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article, User $user)
    {
      // 获取文章分类数据(获取全部)
      $categories = Category::with('article') ->get();
      // 获取全部文章
      $articles = Article::with('user', 'category') ->withCount(['articleZans as articleZans_count', 'comment as comment_count']) ->get();
      // 随机获取5个用户
      $users = User::orderBy(\DB::raw('RAND()')) ->take(5) ->get();

      // 返回后台首页
      return view('home', compact('categories', 'articles', 'users'));
    }


    // 导航条搜索
    public function search(Request $request) {
  		$where = '';

  		if ( $request->has('title') ) {
			     $article = Article::where('title', 'like', "%" . $request ->title . "%") ->first();
  		}

      return redirect() ->route('articles.show', $article);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
