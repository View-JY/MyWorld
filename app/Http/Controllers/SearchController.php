<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
      $search = "%" . $request ->text . "%";

      $model_article = $this ->applyConditions([['title', 'like', $search]]);
      $model_user = $this ->applyUser([['name', 'like', $search]]);

      $articles = $model_article ->get();
      $users = $model_user ->get();

      // 最近搜索
      $recently = $this ->recently($request ->text);

      return view('search.index', compact('articles', 'users'));
    }

    private function applyConditions(array $where)
    {
      foreach ($where as $field => $value) {
          if ( is_array($value) ) {
              list($field, $condition, $val) = $value;

              $model = Article::where($field, $condition, $val);
          } else {
              $model = Article::where($field, '=', $value);
          }
      }

      return $model;
    }

    private function applyUser(array $where)
    {
      foreach ($where as $field => $value) {
          if ( is_array($value) ) {
              list($field, $condition, $val) = $value;

              $model = User::where($field, $condition, $val);
          } else {
              $model = User::where($field, '=', $value);
          }
      }

      return $model;
    }

    private function recently($text)
    {

    }
}
