<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * 标签列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有标签
        $tags = Tag::select('id','tag_name') -> get();
        
        return view('admin.tags.index',['tags'=>$tags]);
    }

    /**
     * 删除标签
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        // 如果该标签有对应的文章,则将该文章下的此标签删除
        if(!$tag -> article -> isEmpty()){
            $tag -> article() ->detach();
        }
        // 删除这个标签
        $tag -> delete();

        return back() ->with('success','删除标签成功!');

    }
}
