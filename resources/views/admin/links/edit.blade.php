@extends('admin.layouts.app')

@section('content')
@include('commons._message')
<a href="/admin/links" class="btn btn-info">返回</a>
<form action="/admin/links/{{ $link ->id }}" method="post">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
  	<div class="form-group">
	    <label for="exampleInputEmail1">链接名称</label>
	    <input type="text" class="form-control" name="title" value="{{ $link ->title }}" id="title" placeholder="链接名称">
  	</div>
  	<div class="form-group">
	    <label for="exampleInputEmail1">链接地址</label>
	    <input type="text" class="form-control" name="link" value="{{ $link ->link }}" id="link" placeholder="链接地址">
  	</div>
  	<button type="submit" class="btn btn-warning">修改</button>
</form>
@endsection