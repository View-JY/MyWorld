<?php

namespace App\Presenters;

use App\Models\Article;

class ArticlePresenter
{
  /**
   * 获取热门文章
   * @return mixed
   */
  public function hotArticleList()
  {
      $hostArticleList = Article::orderBy('comment_count','desc') ->with('comment') ->withCount(['articleZans as articleZans_count', 'comment as acomment_count']) ->paginate(5);

      return $hostArticleList;
  }
}
