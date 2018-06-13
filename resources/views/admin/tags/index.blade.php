@extends('admin.layouts.app')

@section('content')

@include('commons._message')
<table class="table table-striped">
	<thead>
		<tr>
			<td>#</td>
			<td>标签名</td>
			<td>操作</td>
		</tr>
	</thead>
	<tbody>
		@foreach($tags as $key=>$value)
		<tr>
			<td>{{ $value -> id }}</td>
			<td>{{ $value -> tag_name }}</td>
			<td>
				<form action="{{ route('admin.tags.destroy',$value ->id) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger follow">删除</button>
				</form>				
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection