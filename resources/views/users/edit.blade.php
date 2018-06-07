@extends('layouts.app')

<!-- Styles -->
@section('styles')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container setting">
  <div class="row">
      <!--  -->
      <div class="my">
        <div class="my-view">
          @include('commons._message')
          <!--  -->
          <div class="ProfileHeader-contentHead">
            <h1 class="ProfileHeader-title">
              <span class="ProfileHeader-name">{{ $user ->name }}</span>
            </h1>

            <!--  -->
            @if(empty($userinfo))
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
            @else
            <form action="{{ route('users.update', $user) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
            @endif
              {{ csrf_field() }}
              <input type="hidden" name="user_id" value="{{ $user ->id }}">
              <!--  -->
              <div class="UserAvatarEditor ProfileHeader-avatar">
                <div class="UserAvatar">
                  <input type="file" id="input-file-now-custom-2" class="dropify"  data-height="168" name="avatar" @if(isset($userinfo)) data-default-file="{{ $userinfo ->avatar }}" @endif/>
                </div>
              </div>

              <!--  -->
              <div class="form-group">
                <label for="exampleInputName2">性别</label>

                <label class="radio-inline">
                  <input type="radio" name="sex" id="inlineRadio1" value="0" @if(isset($userinfo) && $userinfo ->sex ==  '0') checked  @endif> 保密
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" id="inlineRadio2" value="1" @if(isset($userinfo) && $userinfo ->sex ==  '1') checked  @endif> 男
                </label>
                <label class="radio-inline">
                  <input type="radio" name="sex" id="inlineRadio3" value="2" @if(isset($userinfo) && $userinfo ->sex ==  '2') checked  @endif> 女
                </label>
              </div>

              <!--  -->
              <div class="form-group">
                <label for="exampleInputName2">一句话描述你自己</label>
                <input type="text" class="form-control Input-wrapper" name="introduction" id="exampleInputName2" placeholder="一句话描述你自己" value="@if(isset($userinfo)) {{ $userinfo ->introduction }} @endif">
              </div>

              <!--  -->
              <div class="form-group">
                <label for="exampleInputName2">个人网站</label>
                <input type="text" class="form-control Input-wrapper" name="url" id="exampleInputName2" placeholder="个人网站" value="@if(isset($userinfo)) {{ $userinfo ->url }} @endif">
              </div>
              <!--  -->
              <button type="submit" class="btn btn-default">点击提交</button>
            </form>
            <!--  -->
          </div>
        </div>
      </div>
      <!--  -->
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('dropify/js/dropify.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    // 上传图片
    $('#input-file-now-custom-2').dropify();

    // 编辑器
    var editor = new Simditor({
        textarea: $('#editor'),
        upload: {
            url: '{{ route('articles.upload_image') }}',
            params: { _token: '{{ csrf_token() }}' },
            fileKey: 'upload_file',
            connectionCount: 10,
            leaveConfirm: '文件上传中，关闭此页面将取消上传。'
        },
        pasteImage: true,
    });

    // bootstrap 弹出框
    $('[data-toggle="popover"]').popover()
  });
</script>
@endsection
