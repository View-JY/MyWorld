<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Auth;

class NoticesController extends Controller
{
    public function index()
    {
      // 获取我收到的消息
      $user = Auth::user();
      $notices = $user ->notices;

      return view('notices.index');
    }

    public function edit($id)
    {
      $notice = Notice::find($id);
      $notices = Notice::all();

      return view('notices.show', compact('notice', 'notices'));
    }
}
