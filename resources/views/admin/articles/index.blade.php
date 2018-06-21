@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <table class="table table-striped">
      <thead>
        <tr>
          <td>#</td>
          <td>文章标题</td>
          <td>操作</td>
        </tr>
      </thead>
      <tbody>
        @foreach($articles as $article)
        <tr>
          <td>{{ $article ->id }}</td>
          <td>
            <a href="{{ route('articles.show', $article) }}">{{ $article ->title }}</a></td>
          <td>
            <a href="{{ route('admin.articles.status', ['id' => $article ->id, 'status' => '1']) }}">通过</a>
            <a href="{{ route('admin.articles.status', ['id' => $article ->id, 'status' => '-1']) }}">拒绝</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $articles ->links() }}
  </div>
@endsection
