@extends('admin.layouts.app')

@section('styles')
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div>

    @include('commons._message')

    @if( !empty($category ->id) )
    <form role="form" action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
      <input type="hidden" name="_method" value="PUT">
    @else
    <form role="form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
    @endif
          {{csrf_field()}}

          <div class="box-body">
            <div class="form-group">
                <label >分类封面</label>
                <input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="cover" data-default-file="@if(!empty($category)){{$category ->cover}}@endif" @if( empty($category) )required @endif/>
            </div>
          </div>

          <div class="box-body">
              <div class="form-group">
                  <label >分类名称</label>
                  <input type="text" class="form-control" name="name" value="@if(!empty($category)){{ $category ->name }}@endif" required/>
              </div>
          </div>
          <div class="box-body">
              <div class="form-group">
                  <label>分类描述</label>
                  <input type="text" class="form-control" name="description" value="@if(!empty($category)){{ $category ->description }}@endif" required>
              </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">提交</button>
          </div>
      </form>

  </div>
@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // 上传图片
    $('#input-file-now-custom-2').dropify();

    // bootstrap 弹出框
    $('[data-toggle="popover"]').popover();
  });
</script>
@endsection
