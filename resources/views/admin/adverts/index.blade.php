@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <a href="{{ route('admin.adverts.create') }}" class="btn btn-success">创建广告</a>

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
        @foreach($adverts as $advert)
        <tr>
          <td>{{ $advert ->id }}</td>
          <td>{{ $advert ->name }}</td>
          <td>{{ $advert ->cover }}</td>
          <td>{{ $advert ->link }}</td>
          <td>
            <a href="{{ route('admin.adverts.edit', $advert) }}">修改</a>
            <a href="{{ route('admin.adverts.delete', $advert) }}">删除</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $adverts ->links() }}
  </div>
@endsection
