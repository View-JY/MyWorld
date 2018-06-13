@extends('admin.layouts.app')

@section('content')
@include('commons._message')
<a href="/admin/links" class="btn btn-info">返回</a>
<form action="/admin/links" method="post">
	{{ csrf_field() }}
  	<div class="form-group">
	    <label for="exampleInputEmail1">链接名称</label>
	    <input type="text" class="form-control" required name="title" id="title" placeholder="链接名称">
  	</div>
  	<div class="form-group">
	    <label for="exampleInputEmail1">链接地址</label>
	    <input type="text" class="form-control" name="link" required id="link" placeholder="链接地址">
  	</div>
  	<button type="submit" class="btn btn-success">添加</button>
</form>
@endsection