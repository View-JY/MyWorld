@extends('admin.layouts.app')

@section('styles')
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')
<div>
	<h1 class="btn btn-success" >添加页面</h1>
</div>

<div class="row btn btn-info" style="margin:20px;">
	
	<form action="/admin/adverts" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	  <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌名称</label>
	    <input type="text" class="form-control" id="" placeholder="" name="name">
	  </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌链接</label>
	    <input type="text" class="form-control" id="" placeholder="" name="url">
	  </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">品牌logo</label>
     
 		<input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="image" data-default-file=""/>

	  </div>
	   <div class="form-group"style="width:900px;">
	    <label for="exampleInputEmail1">权重</label>
	    <input type="text" class="form-control" id="" placeholder="" name="weight">
	  </div>


	  <button type="submit" style="width:900px;" class="btn btn-success">提交</button>
	</form>
</div>

@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
  
        $('#input-file-now-custom-2').dropify();

 </script>
@endsection