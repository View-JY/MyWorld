<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Auth;

class CommentsController extends Controller
{
  // 验证是否登录
  public function __construct()
  {
      $this->middleware('auth');
  }

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
      $this ->authorize('destroy', $comment);
      $reply ->delete();

      return redirect()->route('replies.index')->with('success', '删除成功！');
  }
}
