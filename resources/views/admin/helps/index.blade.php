@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>内容</td>
          <td>联系方式</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($helps as $help)
        <tr>
          <td>{{ $help ->id }}</td>
          <td>{{ $help ->content }}</td>
          <td>{{ $help ->contact }}</td>
          <td>
            <a href="{{ route('admin.helps.delete', $help) }}">删除</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $helps ->links() }}
  </div>
@endsection
