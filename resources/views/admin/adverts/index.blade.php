@extends('admin.layouts.app')

@section('content')
 <h2 class="admin-title">广告管理 <small>审核广告</small></h2>

 <div class="row" style="padding: 10px 0 20px;border-bottom: 1px solid #f0f0f0;">		
		<table class="table table-bordered" style="margin-top: 15px;">
		<a class="btn btn-info" href="adverts/create">添加</a>
			<tr style="overflow:hidden; width:500px;">
				<th>ID</th>
				<th>品牌名称</th>
				<th>品牌链接</th>
				<th style="width:50px;">品牌logo</th>
				<th>权重</th>
				<th>操作</th>
			</tr>
			@foreach($adverts as $advert)
			<tr >
				<td>{{ $advert -> id }}</td>
				<td>{{ $advert -> name }}</td>
				<td>{{ $advert -> url }}</td>
				<td style="width:50px;">{{ $advert -> image }}</td>
				<td>{{ $advert -> weight }}</td>
				<td>
					 <form action="adverts/{{ $advert -> id }}" method="post" style="display: inline;">
	                    {{ csrf_field() }}
	                    {{ method_field('DELETE') }}
	                    <input type="submit" value="删除" class="btn btn-danger">
	                </form>
					<a href="adverts/{{ $advert -> id }}/edit" class="btn btn-warning">修改</a>
					
				</td>
			</tr>
			@endforeach
		</table>

	</div>
@endsection