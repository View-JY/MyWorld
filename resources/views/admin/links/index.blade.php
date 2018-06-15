@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <a href="{{ route('admin.links.create') }}" class="btn btn-success">创建友情资源</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>名称</td>
          <td>地址</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($links as $link)
        <tr>
          <td>{{ $link ->id }}</td>
          <td>{{ $link ->title }}</td>
          <td>{{ $link ->link }}</td>
          <td>
            <a href="{{ route('admin.links.edit', $link) }}">修改</a>
            <a href="{{ route('admin.links.delete', $link) }}">删除</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $links ->links() }}
  </div>
@endsection
