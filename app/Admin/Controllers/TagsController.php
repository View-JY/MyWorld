<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use DB;

class TagsController extends Controller
{
    public function index()
    {
      $tags = Tag::paginate(20);

      return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
      return view('admin.tags.create');
    }

    public function delete($id)
    {
      $tag = Tag::find($id);

      DB::transaction(function () use($tag) {
          $res = $tag ->article() ->detach();

          $res = $tag ->delete();
      }, 5);

      return back() ->with('success', '标签删除成功');
    }

    public function store(Request $request)
    {
      $this ->validate($request, [
        'tag_name' => 'required|min:1',
      ], [
        'tag_name.required' => '标签名称不能为空',
        'tag_name.min' => '标签名称太短',
      ]);

      Tag::create($request ->all());

      return redirect('/admin/tags') ->with('success', '标签创建成功');
    }
}
