<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Handlers\ImageUploadHandler;
use Auth;

class AdvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有广告数据
        $adverts = Advert::get();
        return view('admin.adverts.index',['adverts'=>$adverts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Advert $advert, ImageUploadHandler $uploader)
    {

       
        if ($request->image) {
            // 保存图片
            $result = $uploader->save($request->image, 'image', Auth::id(), 300);
            // 添加数据
           if ($result) {
              $advert ->image = $result['path'];
           }
        }

         // 保存字段以及图片到数据库
        $advert -> name = $request -> input('name');
        $advert -> url = $request -> input('url');
        $advert -> weight = $request -> input('weight');
        $advert -> image = $advert ->image;

        $res = $advert -> save();

        if($res){
            return redirect('admin/adverts') -> with('success','添加成功');
        }else{
            return back() -> with('error','添加失败了');
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
        // 查询要修改那一条的数据
        $advert = new Advert;
        // 通过id查询字段
        $adverts = $advert -> where('id',$id) -> get();
        return view('admin/adverts/edit',['adverts'=>$adverts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advert $advert, ImageUploadHandler $uploader)
    {
        // 用fill方法保存所有字段
        $res = $advert ->fill($request -> all());
        if ($request->image) {
            // 保存图片
            $result = $uploader->save($request->image, 'image', Auth::id(), 300);
            // 添加数据
           if ($result) {
              $advert ->image = $result['path'];
           }
        }

        $res = $advert -> save();
        if($res){
            return redirect('/admin/adverts') -> with('success','修改成功');
        }else{
            return back() -> with('error','修改失败,再来一次');
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
        // 删除数据库的数据
        $adverts = Advert::find($id);
        $res = $adverts -> delete();
        if($res){
            return redirect('/admin/adverts') -> with('success','删除成功');
        }else{
            return back() -> with('error','删除失败');
        }
    }
}
