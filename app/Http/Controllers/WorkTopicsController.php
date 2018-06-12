<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\WorkTopic;
use App\Http\Requests\TopicRequest;
use App\Handlers\ImageUploadHandler;
use Auth;

class WorkTopicsController extends Controller
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
    public function create($id)
    {
      //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function write($id)
    {
      $work = Work::find($id);

      return view('topics.create_and_edit', compact('work'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request, ImageUploadHandler $uploader, WorkTopic $workTopic)
    {
      // 处理数据
      $workTopic->fill($request->all());

      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($workTopic->cover, 'topics', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $workTopic ->cover = $result['path'];
        }
      }

      // 保存到数据库
      $workTopic->save();

      // 页面跳转并返回信息
      return redirect() ->route('topics.show', $workTopic) ->with('success', '文章创建成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // 获取当前文章
      $topic = WorkTopic::find($id);

      // 上一篇
      $prev_article = $this ->getPrevArticleId($id);

      // 下一篇
      $next_article = $this ->getNextArticleId($id);

      return view('topics.show', compact('topic', 'prev_article', 'next_article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // 获取文章
      $topic = WorkTopic::find($id);
      // 获取文集
      $work = $topic ->work;

      return view('topics.create_and_edit', compact('work', 'topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, ImageUploadHandler $uploader, WorkTopic $workTopic)
    {
      // 处理数据
      $workTopic->fill($request->all());

      // 判断是否有图片存在
      if ($request->cover) {
        // 保存图片
        $result = $uploader->save($workTopic->cover, 'topics', Auth::id(), 362);
        // 添加数据
        if ($result) {
            $workTopic ->cover = $result['path'];
        }
      }

      // 保存到数据库
      $workTopic->save();

      // 页面跳转并返回信息
      return redirect() ->route('topics.show', $workTopic) ->with('success', '文章修改成功');
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
      $topic = WorkTopic::find($id);

      $topic ->delete();

      return redirect() ->route('users.show', Auth::id()) ->with('success', '文章删除成功');
    }

    // 上一篇
    protected function getPrevArticleId($id)
    {
        return WorkTopic::where('id', '<', $id) ->max('id');
    }

    // 下一篇
    protected function getNextArticleId($id)
    {
        return WorkTopic::where('id', '>', $id) ->min('id');
    }
}
