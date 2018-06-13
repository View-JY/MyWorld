@extends('admin.layouts.app')

@section('styles')
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('commons._message')
<a href="/admin/friends" class="btn btn-info">返回</a>
<form action="/admin/friends/{{ $friend ->id }}" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="row">
		<div class="col-xs-4">
			<label for="input-file-now-custom-2">链接logo</label>
			<input type="file" id="input-file-now-custom-2" class="dropify" data-height="100" data-width="80" name="logo" data-default-file="@if($friend){{$friend ->logo}}@endif"/>
		</div>
		<div class="col-xs-8"></div>
	</div>
	
	<div class="form-group">
	    <label for="name">链接名称</label>
	    <input type="text" class="form-control" name="name" value="{{ $friend ->name }}" id="name" placeholder="链接名称">
	</div>
	<div class="form-group">
	    <label for="link">链接地址</label>
	    <input type="text" class="form-control" name="link" value="{{ $friend ->link }}" id="link" placeholder="链接地址">
	</div>
	<button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#input-file-now-custom-2').dropify();
	});
</script>
@endsection