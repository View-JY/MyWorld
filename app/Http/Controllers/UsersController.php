<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Models\Work;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取全部作者信息
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // 创建个人信息页面
      return view('users.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageUploadHandler $uploader)
    {
      $data = [];
      $data['user_id'] = $request ->user_id;
      $data['sex'] = $request ->sex;
      $data['introduction'] = $request ->introduction;
      $data['url'] = $request ->url;

      // 是否有图片
      if ($request->avatar) {
        // 保存图片
        $result = $uploader->save($request->avatar, 'avatar', Auth::id(), 362);
        // 添加数据
        if ($result) {
          $data['avatar'] = $result['path'];
        }
      }

      // 创建
      UserInfo::create($data);

      return back() ->with('success', '个人资料创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      // 获取所有文集
      $works = Work::all();

      return view('users.show', compact('user', 'works'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询用户信息
        $user = User::find($id);

        // 查询用户基本信息 empty || Object
        $userinfo = $user ->userinfo;
        if ( empty($userinfo) ) {
          $user_data = compact('user');
        } else {
          $user_data = compact('user', 'userinfo');
        }

        // 修改个人信息页面
        return view('users.edit', $user_data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImageUploadHandler $uploader, User $user)
    {
      $user ->userinfo ->user_id = $user ->id;
      $user ->userinfo ->sex = $request ->sex;
      $user ->userinfo ->introduction = $request ->introduction;
      $user ->userinfo ->url = $request ->url;

      // 是否有图片
      if ($request->avatar) {
        // 保存图片
        $result = $uploader->save($request->avatar, 'avatar', Auth::id(), 362);
        // 添加数据
        if ($result) {
          $user ->userinfo ->avatar = $result['path'];
        }
      }

      // 更新
      $user ->userinfo ->update();

      return back() ->with('success', '个人资料修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
