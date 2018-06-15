<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $notices = Notice::all();
      return view('admin.notices.index', compact('notices'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('admin.notices.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function store(Request $request)
  {
      $this->validate($request, [
          'title' => 'required|min:3',
          'content' => 'required|min:3'
      ]);

      $notice = Notice::create(request(['title', 'content']));

      dispatch(new \App\Jobs\SendMessage($notice));

      return redirect('/admin/notices');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Topic  $topic
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Topic  $topic
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Topic  $topic
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Topic $topic)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Topic  $topic
   * @return \Illuminate\Http\Response
   */
  public function destroy()
  {
  }
}
