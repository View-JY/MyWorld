<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;

class CommentsController extends Controller
{
    public function index()
    {
      $comments = Comment::withoutGlobalscope('status') ->orderBy('created_at', 'desc') ->paginate(10);
      $reports = Report::all();

      return view('admin.comments.index', compact('comments', 'reports'));
    }

    public function status($id, $status)
    {
      $comment = Comment::find($id);
      $comment ->status = $status;
      $comment ->save();

      return back() ->with('success', '评论审核成功');
    }
}
