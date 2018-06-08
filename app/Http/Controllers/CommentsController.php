<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentZan;
use App\Models\Report;
use App\User;
use App\Http\Requests\CommentRequest;
use Auth;
use DB;

class CommentsController extends Controller
{

  // 提交
  public function store(CommentRequest $request, Comment $comment)
  {
      // 数据仓库
      $response_data = [];

      // 存入数据库
      $res = Comment::create($request ->all());

      if ( $res ) {
        // 返回状态码
        $response_data['code'] = '200';
        // 返回评论信息
        $response_data['msg']['body'] = $request ->body;
        $response_data['msg']['user_id'] = $request ->user_id;
        $response_data['msg']['article_id'] = $request ->article_id;
        $response_data['msg']['parent_id'] = $request ->parent_id;

        $response_data['msg']['comment_id'] = $res ->id;
        $response_data['msg']['created_at'] = $res ->created_at;

        $response_data['msg']['user_name'] = $res ->user ->name;
      } else {
        // 返回状态码
        $response_data['code'] = '400';
      }

      return json_encode($response_data);
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

  // 举报
  public function commentReport($id)
  {
    // 获取对应文章
    $comment = Comment::find($id);
    // 所需参数
    $params = [
        'user_id'  => Auth::id(),
        'comment_id' => $comment ->id
    ];

    // 确保一个人只能赞一次
    Report::firstOrCreate($params);

    return back() ->with('success', '举报成功，系统会尽快审核');
  }
}
