@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <div class="box">

      <div class="box box-primary">
          <form role="form" action="/admin/notices" method="POST">
              {{csrf_field()}}
              <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">标题</label>
                      <input type="text" class="form-control" name="title">
                  </div>
              </div>
              <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">内容</label>
                      <textarea class="form-control" name="content"></textarea>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">提交</button>
              </div>
          </form>
      </div>
  </div>

  </div>
@endsection
