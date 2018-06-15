<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class LinksController extends Controller
{
    public function index()
    {
      $links = Link::paginate(10);

      return view('admin.links.index', compact('links'));
    }

    public function create()
    {
      return view('admin.links.create');
    }

    public function store(Request $request)
    {
      $this ->validate($request, [
        'title' => 'required|min:2',
        'link' => 'required|min:2',
      ]);

      Link::create($request ->all());

      return back() ->with('success', '资源创建成功');
    }

    public function edit($id)
    {
      $link = Link::find($id);

      return view('admin.links.create', compact('link'));
    }

    public function update($id)
    {
      $this ->validate(request(), [
        'title' => 'required|min:2',
        'link' => 'required|min:2',
      ]);

      $links = Link::find($id);

      $links ->update(request() ->all());

      return back() ->with('success', '资源修改成功');
    }

    public function delete($id)
    {
      $links = Link::find($id);

      $links ->delete();

      return back() ->with('success', '资源删除成功');
    }
}
