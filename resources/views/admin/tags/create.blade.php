@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <form role="form" action="/admin/tags/store" method="POST">
          {{csrf_field()}}

          <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">标签名称</label>
                  <input type="text" class="form-control" name="tag_name">
              </div>
          </div>

          <!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">提交</button>
          </div>
      </form>
  </div>
@endsection
