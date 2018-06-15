<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Advert;
use App\Models\FirendLink;
use App\Models\Notice;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Article $article, User $user)
    {
      // 获取文章分类数据
      $categories = Category::with('article') ->orderBy(DB::raw('RAND()')) ->take(7) ->get();

      // 获取全部文章
      $articles = Article::with('user', 'category') ->withCount(['articleZans as articleZans_count', 'comment as comment_count']) ->paginate(15);

      // 随机获取5个用户
      $users = User::orderBy(DB::raw('RAND()')) ->take(5) ->get();

      // 广告位
      $adverts = Advert::orderBy('weight', 'desc') ->get();

      // 友情链接
      $firendlinks = FirendLink::all();

      // 系统消息
      $notices = Notice::orderBy('created_at', 'desc') ->get();

      // 作者排行
      $seniorities = User::orderBy('hot_count', 'desc') ->limit(5) ->get();

      // 返回后台首页
      return view('home', compact('categories', 'articles', 'users', 'adverts', 'firendlinks', 'notices', 'seniorities'));
    }


    // 导航条搜索
    public function search(Request $request) {
  		$where = '';

  		if ( $request->has('title') ) {
			     $article = Article::where('title', 'like', "%" . $request ->title . "%") ->first();
  		}

      return redirect() ->route('articles.show', $article);
  	}
}
