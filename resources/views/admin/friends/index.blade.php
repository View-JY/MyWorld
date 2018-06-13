@extends('admin.layouts.app')

@section('content')
@include('commons._message')
<a class="btn btn-success" href="/admin/friends/create">添加链接</a>
<table class="table table-striped">
	<tr>
		<td>#</td>
		<td>logo</td>
		<td>链接名称</td>
		<td>链接地址</td>
		<td>操作</td>
	</tr>
	@foreach($friends as $key=>$value)
		<tr>
			<td>{{ $value ->id }}</td>
			<td><a href="{{ $value ->logo }}" target="_blank"><img width="25px" height="25px" src="{{ $value ->logo }}"></a></td>
			<td>{{ $value ->name }}</td>
			<td>{{ $value ->link }}</td>
			<td>
				<form action="/admin/friends/{{ $value ->id }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<a class="btn btn-warning" href="/admin/friends/{{ $value ->id }}/edit">修改</a>
					<button class="btn btn-danger" type="submit">删除</button>
				</form>
			</td>
		</tr>
	@endforeach
</table>
@endsection