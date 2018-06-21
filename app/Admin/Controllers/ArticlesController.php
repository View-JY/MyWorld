<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticlesController extends Controller
{
  public function index()
  {
    $articles = Article::withoutGlobalscope('status') ->orderBy('created_at', 'desc') ->paginate(10);

    return view('admin.articles.index', compact('articles'));
  }

  public function status($id, $status)
  {
    Article::find($id) ->update(['status' => $status]);

    return back() ->with('success', '文章审核成功');
  }


}
