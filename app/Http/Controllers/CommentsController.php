<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentZan;
use App\Http\Requests\CommentRequest;
use Auth;
use DB;

class CommentsController extends Controller
{

  // 提交
  public function store(CommentRequest $request, Comment $comment)
  {
      $comment ->body = $request ->body;
      $comment ->user_id = Auth::id();
      $comment ->article_id = $request->article_id;
      $comment ->save();

      return back() ->with('success', '回复发表成功');
  }

  // 删除
  public function destroy(Comment $comment)
  {
    // 事务
    DB::transaction(function () use($comment) {
      // 评论删除
      $comment ->delete();

      // 关联评论赞删除
      $comment ->commentZans() ->delete();
    }, 5);

    return redirect()->route('articles.show', $comment ->article)->with('success', '评论删除成功！');
  }

  // 赞评论
  public function commentZan($id)
  {
    // 获取对应文章
    $comment = Comment::find($id);
    // 所需参数
    $params = [
        'user_id'  => Auth::id(),
        'comment_id' => $comment ->id
    ];
    // 确保一个人只能赞一次
    CommentZan::firstOrCreate($params);

    return back() ->with('success', '评论点赞成功');
  }

  // 取消赞评论
  public function unCommentZan($id)
  {
    // 获取对应文章
    $article = Comment::find($id);
    $article ->CommentZan(Auth::id()) ->delete();

    return back() ->with('success', '取消评论点赞成功');
  }
}
