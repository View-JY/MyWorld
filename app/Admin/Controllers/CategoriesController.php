<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Handlers\ImageUploadHandler;
use Auth;

class CategoriesController extends Controller
{
    public function index()
    {
      $categories = Category::paginate(10);

      return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
      return view('admin.categories.create');
    }

    public function store(CategoryRequest $request, ImageUploadHandler $uploader, Category $category)
    {
      // 处理数据
      $category ->fill($request->all());

      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save( $category->cover, 'categories', Auth::id(), 362 );
        // 添加数据
        if ($result) {
            $category ->cover = $result['path'];
        }
      }

      // 保存到数据库
      $category->save();

      // 页面跳转并返回信息
      return redirect() ->route('admin.categories', $category) ->with('success', '分类创建成功');
    }

    public function edit($id)
    {
      $category = Category::find($id);

      return view('admin.categories.create', compact('category'));
    }

    public function update(CategoryRequest $request, ImageUploadHandler $uploader, Category $category)
    {
      // 处理数据
      $category ->fill($request->all());

      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save( $category->cover, 'categories', Auth::id(), 362 );
        // 添加数据
        if ($result) {
            $category ->cover = $result['path'];
        }
      }

      // 保存到数据库
      $category->save();

      // 页面跳转并返回信息
      return redirect() ->route('admin.categories', $category) ->with('success', '分类保存成功');
    }
}
