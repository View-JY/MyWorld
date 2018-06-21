@extends('admin.layouts.app')

@section('content')
  <a type="button" class="btn btn-success" href="/admin/categories/create" style="margin-bottom: 15px;">增加分类</a>

  <div>

    @include('commons._message')

    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
              <tr>
                  <th style="width: 10px">#</th>
                  <th>分类名称</th>
                  <th style="width: 600px">描述</th>
                  <th>文章数量</th>
                  <th>操作</th>
              </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}.</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->article ->count()}}</td>
                    <td>
                      @if($category->article ->count() == 0)
                        <a href="{{ route('admin.categories.edit', $category ->id) }}">修改</a>
                        <a href="{{ route('admin.categories.delete', $category ->id) }}">删除</a>
                      @else
                        <span>已有文章，不能操作</span>
                      @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$categories->links()}}
  </div>
@endsection
