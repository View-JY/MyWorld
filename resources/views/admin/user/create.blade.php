@extends('admin.layouts.app')

@section('content')
  @include('commons._error')

  <form action="{{ route('admin.users.store') }}" method="POST" role="form">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">用户名</label>
      <input type="text" class="form-control" id="name" placeholder="用户名" name="name" value="{{ old('name') }}" required />
    </div>

    <div class="form-group">
      <label for="password">密码</label>
      <input type="password" class="form-control" id="password" placeholder="密码" name="password" value="{{ old('password') }}" required>
    </div>

    <button type="submit" class="btn btn-success">点击添加</button>
  </form>
@endsection
