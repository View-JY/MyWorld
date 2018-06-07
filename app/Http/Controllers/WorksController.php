<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Http\Requests\WorkRequest;
use App\Handlers\ImageUploadHandler;
use Auth;

class WorksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('works.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkRequest $request, ImageUploadHandler $uploader, Work $work)
    {
      // 处理数据
      $work->fill($request->all());
      // 当前用户ID
      $work->user_id = Auth::id();
      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($work->cover, 'work', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $work ->cover = $result['path'];
        }
      }
      // 保存到数据库
      $work->save();

      return back() ->with('success', '文集创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 获取当前文集
        $work = Work::find($id);

        return view('works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // 获取当前专题
      $work = Work::find($id);

      return view('works.create', compact('work'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkRequest $request, ImageUploadHandler $uploader, Work $work)
    {
      // 处理数据
      $work->fill($request->all());
      // 当前用户ID
      $work->user_id = Auth::id();
      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($work->cover, 'work', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $work ->cover = $result['path'];
        }
      }
      // 保存到数据库
      $work->save();

      return redirect() ->route('works.show', $work) ->with('success', '文集修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // 获取当前专题
      $work = Work::find($id);

      $work ->delete();

      return redirect() ->route('users.show', Auth::id()) ->with('success');
    }
}
