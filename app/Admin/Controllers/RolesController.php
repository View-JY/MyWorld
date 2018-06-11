<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\AdminPermission;

class RolesController extends Controller
{
  public function index()
  {
    $roles = AdminRole::paginate(10);

    return view('admin.roles.index', compact('roles'));
  }

  public function create()
  {
    return view('admin.roles.create');
  }

  public function store()
  {

    $this->validate(request(), [
        'name' => 'required',
        'description' => 'required',
    ]);

    AdminRole::create(request(['name', 'description']));

    return redirect('/admin/roles');
  }

  public function permission(AdminRole $role)
  {
    $permissions = AdminPermission::all();

    $myPermissions = $role ->permissions;

    return view('admin.roles.permission', compact('permissions', 'myPermissions', 'role'));
  }

  public function storePermission(AdminRole $role)
  {
    $this->validate(request(),[
       'permissions' => 'required|array'
    ]);

    $permissions = AdminPermission::find(request('permissions'));
    $myPermissions = $role->permissions;

    // 对已经有的权限
    $addPermissions = $permissions->diff($myPermissions);
    foreach ($addPermissions as $permission) {
        $role->grantPermission($permission);
    }

    $deletePermissions = $myPermissions->diff($permissions);
    foreach ($deletePermissions as $permission) {
        $role->deletePermission($permission);
    }
    return back();
  }
}
