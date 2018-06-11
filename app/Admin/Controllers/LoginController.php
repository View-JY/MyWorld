<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
  // 展示登录页面
  public function index()
  {
    return view('admin.login.index');
  }

  // 登录行为
  public function login()
  {
    $this ->validate(request(), [
      'name' =>'required|min:2',
      'password' => 'required|min:5|max:10',
    ]);

    $user = request(['name', 'password']);

    if ( Auth::guard('admin') ->attempt($user) ) {
      return redirect() ->route('admin.home');
    }

    return back() ->with('danger', '用户名密码错误');
  }

  // 登出行为
  public function logout()
  {
    Auth::guard('admin') ->logout();

    return redirect() ->route('admin.login');
  }


}
