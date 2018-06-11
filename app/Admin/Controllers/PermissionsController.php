<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminPermission;

class PermissionsController extends Controller
{
  public function index()
  {
      $permissions = AdminPermission::paginate(10);
      return view('/admin/permissions/index', compact('permissions'));
  }

  /*
   * 创建用户
   */
  public function create()
  {
      return view('/admin/permissions/create');
  }

  /*
   * 创建用户
   */
  public function store()
  {
      $this->validate(request(), [
          'name' => 'required|min:3',
          'description' => 'required'
      ]);

      AdminPermission::create(request(['name', 'description']));
      return redirect('/admin/permissions');
  }
}
