@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <a href="{{ route('admin.tags.create') }}" class="btn btn-success">创建标签</a>

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>标签名称</td>
          <td>文章数量</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($tags as $tag)
        <tr>
          <td>{{ $tag ->id }}</td>
          <td>{{ $tag ->tag_name }}</td>
          <td>{{ $tag ->article ->count() }}</td>
          <td>
            <a href="{{ route('admin.tags.delete', $tag) }}">删除</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $tags ->links() }}
  </div>
@endsection
