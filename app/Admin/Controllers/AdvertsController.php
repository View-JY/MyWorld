<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Handlers\ImageUploadHandler;
use Auth;
use App\Models\Advert;

class AdvertsController extends Controller
{
  public function index()
  {
    $adverts = Advert::paginate(10);

    return view('admin.adverts.index', compact('adverts'));
  }

  public function create()
  {
    return view('admin.adverts.create');
  }

  public function store(Request $request, ImageUploadHandler $uploader,  Advert $advert)
  {
    $this ->validate($request, [
      'name' => 'required|min:2',
      'link' => 'required|min:2',
      'cover' => 'required',
    ]);

    // 处理数据
    $advert ->fill( $request->all() );

    // 判断是否有图片存在
    if ($request ->cover) {
      // 保存图片
      $result = $uploader->save($advert ->cover, 'adverts', Auth::id(), 362);
      // 添加数据
      if ($result) {
          $advert ->cover = $result['path'];
      }
    }

    // 保存到数据库
    $advert->save();

    return back() ->with('success', '广告创建成功');
  }

  public function edit($id)
  {
    $advert = Advert::find($id);

    return view('admin.adverts.create', compact('advert'));
  }

  public function update(Request $request, ImageUploadHandler $uploader,  $id)
  {
    $advert = Advert::find($id);

    // 处理数据
    $advert ->fill($request->all());

    // 判断是否有图片存在
    if ($request->cover) {
      // 保存图片
      $result = $uploader->save( $advert->cover, 'adverts', Auth::id(), 362 );
      // 添加数据
      if ($result) {
          $advert ->cover = $result['path'];
      }
    }

    // 保存到数据库
    $advert ->save();

    // 页面跳转并返回信息
    return redirect() ->route('admin.adverts') ->with('success', '广告修改成功');
  }

  public function delete($id)
  {
    $adverts = Advert::find($id);

    $adverts ->delete();

    return back() ->with('success', '广告删除成功');
  }
}
