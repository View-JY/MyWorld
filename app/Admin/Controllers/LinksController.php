<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Link;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有数据
        $links =Link::all();
        return view('admin.links.index',compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $link = new Link;
        // 当用户输入的数据不为空时
        if(!empty($request->title) && !empty($request->link)){
            $link ->title = $request -> title;
            $link ->link = $request -> link;
            $link ->save();
            return redirect('/admin/links') ->with('success','添加成功');
        }else{
            return back() ->with('danger','请填写正确的链接信息');
        }
        
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
        // 获取当前链接的信息
        $link = Link::find($id);
        return view('admin.links.edit',compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 获取当前链接的信息
        if(!empty($request->title) && !empty($request->link)){
            $newLink = $request ->only('title','link');
            Link::whereId($id) ->update($newLink);
            return redirect('/admin/links')->with('success','修改成功!');
        }else{
            return back() ->with('danger','请填写正确的链接信息');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Link::destroy($id);
        return back()->with('success','删除成功!');
    }
}
