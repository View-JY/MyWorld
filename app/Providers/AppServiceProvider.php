<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Models\Comment;
use App\Observers\ArticleObserver;
use App\Observers\CommentObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // 设置数据库字段长度
  		Schema::defaultStringLength(191);
  		// 设置项目字符集
  		Carbon::setLocale('zh');
      // 文章模型观察器
      Article::observe(ArticleObserver::class);
      // 评论观察器
      Comment::observe(CommentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
