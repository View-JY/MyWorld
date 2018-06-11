@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <form role="form" action="/admin/permissions/store" method="POST">
          {{csrf_field()}}
          <div class="box-body">
              <div class="form-group">
                  <label >权限名</label>
                  <input type="text" class="form-control" name="name">
              </div>
          </div>
          <div class="box-body">
              <div class="form-group">
                  <label>描述</label>
                  <input type="text" class="form-control" name="description">
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">提交</button>
          </div>
      </form>

  </div>
@endsection
