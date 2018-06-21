<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Help;

class HelpsController extends Controller
{
    public function index()
    {
      $helps = Help::paginate(10);

      return view('admin.helps.index', compact('helps'));
    }

    public function delete($id)
    {
      $help = Help::find($id);

      $help ->delete();

      return redirect() ->route('admin.helps') ->with('success', '评论删除成功');
    }
}
