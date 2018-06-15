<?php
namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FirendLink;
use App\Handlers\ImageUploadHandler;
use Auth;

class FirendLinksController extends Controller
{
  public function index()
  {
    $firendlinks = FirendLink::paginate(10);

    return view('admin.firendlinks.index', compact('firendlinks'));
  }

  public function create()
  {
    return view('admin.firendlinks.create');
  }

  public function store(Request $request, ImageUploadHandler $uploader,  FirendLink $firendlink)
  {
    $this ->validate($request, [
      'name' => 'required|min:2',
      'link' => 'required|min:2',
      'cover' => 'required',
    ]);

    // 处理数据
    $firendlink ->fill( $request->all() );

    // 判断是否有图片存在
    if ($request ->cover) {
      // 保存图片
      $result = $uploader->save($firendlink ->cover, 'firendlinks', Auth::id(), 362);
      // 添加数据
      if ($result) {
          $firendlink ->cover = $result['path'];
      }
    }

    // 保存到数据库
    $firendlink->save();

    return back() ->with('success', '友情链接创建成功');
  }

  public function edit($id)
  {
    $firendlink = FirendLink::find($id);

    return view('admin.firendlinks.create', compact('firendlink'));
  }

  public function update(Request $request, ImageUploadHandler $uploader,  $id)
  {
    $firendlink = FirendLink::find($id);

    // 处理数据
    $firendlink ->fill($request->all());

    // 判断是否有图片存在
    if ($request->cover) {
      // 保存图片
      $result = $uploader->save( $firendlink->cover, 'firendlinks', Auth::id(), 362 );
      // 添加数据
      if ($result) {
          $firendlink ->cover = $result['path'];
      }
    }

    // 保存到数据库
    $firendlink ->save();

    // 页面跳转并返回信息
    return redirect() ->route('admin.firendlinks') ->with('success', '友情链接修改成功');
  }

  public function delete($id)
  {
    $firendlink = FirendLink::find($id);

    $firendlink ->delete();

    return back() ->with('success', '友情链接删除成功');
  }
}
