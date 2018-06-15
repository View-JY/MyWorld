@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')
    @if(empty($link))
    <form role="form" action="/admin/links/store" method="POST">
    @else
    <form role="form" action="{{ route('admin.links.update', $link) }}" method="POST">
      <input type="hidden" name="_method" value="PUT">
    @endif
          {{csrf_field()}}

          <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">名称</label>
                  <input type="text" class="form-control" name="title" value="@if(!empty($link)){{ $link ->title }}@endif" required>
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">链接</label>
                  <input type="text" class="form-control" value="@if(!empty($link)){{ $link ->link }}@endif" name="link" required>
              </div>
          </div>

          <!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">提交</button>
          </div>
      </form>
  </div>

@endsection
