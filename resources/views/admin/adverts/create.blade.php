@extends('admin.layouts.app')

@section('styles')
  <link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div>

    @include('commons._message')
    @if(empty($advert))
    <form role="form" action="{{ route('admin.adverts.store') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
    @else
    <form role="form" action="{{ route('admin.adverts.update', $advert) }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
      <input type="hidden" name="_method" value="PUT">
    @endif
          {{csrf_field()}}

          <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">广告图片</label>
                  <input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="cover" data-default-file="@if(!empty($advert)){{ $advert  ->cover }}@endif"/>
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">名称</label>
                  <input type="text" class="form-control" name="name" value="@if(!empty($advert)){{ $advert ->name }}@endif" required>
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">链接</label>
                  <input type="text" class="form-control" value="@if(!empty($advert)){{ $advert ->link }}@endif" name="link" required>
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">权重</label>
                  <input type="number" class="form-control" name="weight" value="@if(!empty($advert)){{ $advert ->weight }}@endif" required>
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
      $('[data-toggle="popover"]').popover()
    });
  </script>
@endsection
