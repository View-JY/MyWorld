<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
      $comments = Comment::withoutGlobalscope('status') ->orderBy('created_at', 'desc') ->paginate(10);

      return view('admin.comments.index', compact('comments'));
    }

    public function status($id, $status)
    {
      $comment = Comment::find($id);
      $comment ->status = $status;
      $comment ->save();

      return back() ->with('success', '评论审核成功');
    }
}
