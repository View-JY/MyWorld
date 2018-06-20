@extends('admin.layouts.app')

@section('styles')
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')

<div>
	<h1 class="btn btn-success" >修改页面</h1>
</div>

<div class="row btn btn-info" style="margin:20px;">
	@foreach($adverts as $advert)
	<form action="/admin/adverts/{{ $advert -> id }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	  <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌名称</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="name" value="{{ $advert -> name }}">
	  </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌链接</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="url" value="{{ $advert -> url }}">
	  </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌logo</label>

	    <input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="image" data-default-file="{{ $advert -> image }}"/>
	  
	   </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">权重</label>
	    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="weight" value="{{ $advert -> weight }}">
	  </div>


	  <button type="submit" style="width:900px;" class="btn btn-success">提交</button>
	</form>
	@endforeach
</div>

@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
  
        $('#input-file-now-custom-2').dropify();

 </script>
@endsection