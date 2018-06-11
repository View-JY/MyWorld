<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdminRole;

class AdminPermission extends Model
{
  protected $fillable = [
    'name', 'description',
  ];

  /*
   * 权限属于哪些角色
   */
  public function roles()
  {
      return $this->belongsToMany(AdminRole::class, 'admin_permission_role', 'role_id', 'permission_id')->withPivot(['permission_id', 'role_id']);
  }
}
