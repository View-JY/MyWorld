@extends('admin.layouts.app')

@section('content')
  <a type="button" class="btn " href="/admin/permissions/create" >增加权限</a>

  <div>

    @include('commons._message')

    <div class="box-body">
        <table class="table table-bordered">
            <tbody><tr>
                <th style="width: 10px">#</th>
                <th>权限名称</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}.</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$permissions->links()}}
  </div>
@endsection
