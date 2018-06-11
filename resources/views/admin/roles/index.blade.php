@extends('admin.layouts.app')

@section('content')
  <a type="button" class="btn " href="/admin/roles/create" >增加角色</a>

  <div>

    @include('commons._message')

    <div class="box-body">
          <table class="table table-bordered">
              <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>角色名称</th>
                  <th>角色描述</th>
                  <th>操作</th>
              </tr>
              @foreach($roles as $role)
                  <tr>
                      <td>{{$role->id}}.</td>
                      <td>{{$role->name}}</td>
                      <td>{{$role->description}}</td>
                      <td>
                          <a type="button" class="btn" href="/admin/roles/{{$role->id}}/permission" >权限管理</a>
                      </td>
                  </tr>
              @endforeach
              </tbody>
            </table>
      </div>
      {{$roles->links()}}
  </div>
@endsection
