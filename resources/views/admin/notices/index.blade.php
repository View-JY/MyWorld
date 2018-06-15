@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <a type="button" class="btn " href="/admin/notices/create">增加通知</a>

    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
              <tr>
                  <th style="width: 10px">#</th>
                  <th>通知名称</th>
                  <th>操作</th>
              </tr>
              @foreach($notices as $notice)
                  <tr>
                      <td>{{$notice->id}}</td>
                      <td>{{$notice->title}}</td>
                      <td></td>
                  </tr>
              @endforeach
            </tbody>
        </table>
    </div>

  </div>
@endsection
