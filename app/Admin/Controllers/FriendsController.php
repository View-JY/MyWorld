<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Handlers\ImageUploadHandler;
use Auth;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有数据
        $friends = Friend::all();
        return view('admin.friends.index',compact('friends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.friends.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Friend $friends,ImageUploadHandler $uploader)
    {
        // dd($request->logo);
        if(!$request ->name || !$request ->link){
            return back()->with('danger','请正确填写链接信息');
        }

        // 判断是否有图片存在
        if ($request->logo) {
            // 保存图片
            $result = $uploader->save($request->logo, 'logo', Auth::id(), 362);
            // 添加数据
            if ($result) {
                $friends ->logo = $result['path'];
            }
        }

        $friends ->name = $request ->name;
        $friends ->link = $request ->link;
        $friends ->save();
        return redirect('/admin/friends') ->with('success','添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $friend = Friend::find($id);
        return view('admin.friends.edit',compact('friend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id ,ImageUploadHandler $uploader)
    {
        if(!$request ->name || !$request ->link){
            return back()->with('danger','请完整填写链接信息');
        }

        $friend = Friend::find($id);
        
        // 判断是否有图片存在
        if ($request->logo) {
            // 保存图片
            $result = $uploader->save($request->logo, 'logo', Auth::id(), 362);
            // 添加数据
            if ($result) {
                $friend ->logo = $result['path'];
            }
        }
        $friend ->name = $request ->name;
        $friend ->link = $request ->link;
        $friend ->save();
        return redirect('/admin/friends') ->with('success','修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Friend::destroy($id);
        return back() ->with('success','删除成功');
    }
}
