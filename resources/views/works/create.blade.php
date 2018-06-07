@extends('layouts.app')

@section('styles')
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
@endsection

@section('content')
<div class="container work-content">
  <div class="row">
    <div class="col-xs-12 main">
      @include('commons._message')

      @if(empty($work))
      <h3>新建专题</h3>
      @else
      <h3>编辑专题</h3>
      @endif

      <!--  -->
      @if(!empty($work) && $work ->id)
      <form class="" action="{{ route('works.update', $work) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <input type="hidden" name="_method" value="PUT">
      @else
      <form class="" action="{{ route('works.store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
      @endif
        {{ csrf_field() }}

        <input type="hidden" name="user_id" value="{{ Auth::id() }}" />

        <table>
          <tbody class="base">
            <tr>
              <td>封面</td>
              <td>
                <div class="avatar-collection">
                  <input type="file" id="input-file-now-custom-2" class="dropify" data-height="150" data-width="150" name="cover" data-default-file="@if(!empty($work)){{ $work ->cover }}@endif" required />
                </div>
              </td>
            </tr>
            <!--  -->
            <tr>
              <td class="setting-title">名称</td>
              <td>
                <input type="text" name="name" placeholder="填写名称，不超过50字" value="@if(!empty($work)) {{$work ->name}} @endif" required />
              </td>
            </tr>
            <!--  -->
            <tr>
              <td class="setting-title pull-left setting-input">描述</td>
              <td>
                <textarea placeholder="填写描述" name="describe" required >@if(!empty($work)) {{ $work ->describe }} @endif</textarea>
              </td>
            </tr>
          </tbody>
        </table>
        @if(!empty($work) && $work ->id)
        <button type="submit" class="btn create">编辑文集</button>
        @else
        <button type="submit" class="btn create">创建文集</button>
        @endif
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // 上传图片
    $('#input-file-now-custom-2').dropify();
  });
</script>
@endsection
