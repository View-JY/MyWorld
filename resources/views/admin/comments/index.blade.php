@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>评论内容</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($reports as $report)
        <tr>
          <td>{{ $report ->comment ->id }}</td>
          <td>{{ $report ->comment ->body }}</td>
          <td>
            <a href="{{ route('admin.comments.status', ['id' => $comment ->id, 'status' => '1']) }}">通过</a>
            <a href="{{ route('admin.comments.status', ['id' => $comment ->id, 'status' => '-1']) }}">拒绝</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $comments ->links() }}
  </div>
@endsection
