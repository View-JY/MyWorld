@extends('admin.layouts.app')

@section('content')
  <div>
    <div class="admin-opt clearfix">
      <a href="{{ route('admin.users.create') }}" class="btn btn-success">增加用户</a>
    </div>

    @include('commons._message')

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>姓名</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($adminUsers as $adminUser)
        <tr>
          <td>{{ $adminUser ->id }}</td>
          <td>{{ $adminUser ->name }}</td>
          <td>
            <a type="button" class="btn" href="/admin/users/{{$adminUser->id}}/role" >角色管理</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <!-- 分页 -->
    {{ $adminUsers ->links() }}
  </div>
@endsection
