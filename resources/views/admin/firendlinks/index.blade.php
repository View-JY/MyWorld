@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <a href="{{ route('admin.firendlinks.create') }}" class="btn btn-success">创建友情链接</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>名称</td>
          <td>图片</td>
          <td>地址</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($firendlinks as $firendlink)
        <tr>
          <td>{{ $firendlink ->id }}</td>
          <td>{{ $firendlink ->name }}</td>
          <td>{{ $firendlink ->cover }}</td>
          <td>{{ $firendlink ->link }}</td>
          <td>
            <a href="{{ route('admin.firendlinks.edit', $firendlink) }}">修改</a>
            <a href="{{ route('admin.firendlinks.delete', $firendlink) }}">删除</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $firendlinks ->links() }}
  </div>
@endsection
