@extends('admin.layouts.app')

@section('content')

@include('commons._message')
<a href="/admin/links/create" class="btn btn-success">添加新链接</a>
<table class="table table-striped">
	<tr>
		<td>#</td>
		<td>链接名</td>
		<td>链接地址</td>
		<td>操作</td>
	</tr>
	@foreach($links as $key=>$value)
	<tr>
		<td>{{ $value -> id }}</td>
		<td>{{ $value -> title }}</td>
		<td>{{ $value -> link }}</td>
		<td>
			<form action="/admin/links/{{ $value ->id }}" method="post">
				{{ method_field('DELETE') }}
				{{ csrf_field() }}
				<a href="/admin/links/{{ $value ->id }}/edit" class="btn btn-warning">修改</a>
				<button type="submit" class="btn btn-danger follow">删除</button>
			</form>
		</td>
	</tr>
	@endforeach
</table>

@endsection
