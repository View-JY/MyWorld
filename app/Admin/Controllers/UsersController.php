<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\AdminRole;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = AdminUser::paginate(10);

        return view('admin.user.index', compact('adminUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this ->validate(request(), [
            'name' => 'required|min:2',
            'password' => 'required|min:2|max:10',
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));

        $res = AdminUser::create(compact('name', 'password'));

        return redirect() ->route('admin.users');
    }

    // 用户角色页面
    public function role(AdminUser $user)
    {
      $roles = AdminRole::all();

      $myRoles = $user ->roles;

      return view('admin.user.role', compact('roles', 'myRoles', 'user'));
    }

    public function storeRole(AdminUser $user)
    {
        $this->validate(request(),[
            'roles' => 'required|array',
        ]);

        $roles = AdminRole::find(request('roles'));
        $myRoles = $user->roles;

        // 对已经有的权限
        $addRoles = $roles->diff($myRoles);
        foreach ($addRoles as $role) {
            $user->roles()->save($role);
        }

        $deleteRoles = $myRoles->diff($roles);
        foreach ($deleteRoles as $role) {
            $user->deleteRole($role);
        }

        return back() ->with('success', 'test');
    }
}
