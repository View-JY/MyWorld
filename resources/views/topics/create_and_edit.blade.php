<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>创建文章</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dropify/css/dropify.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
</head>
<body>
    <div id="app" class="{{ route_class() }}-page">
      <div class="article-wrapper">
        @include('layouts._header')

        <!--  -->
        <div class="container article work">
          <div class="row">
            <!--  -->
            <div class="col-xs-8">
              <div class="article-main">
              <h3 class="title">文集：《 {{ $work ->name }} 》</h3>

              @if(!empty($topic) && $topic ->id)
              <form class="" action="{{ route('topics.update', $topic) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PUT">
              @else
              <form class="" action="{{ route('topics.store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
              @endif
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="work_id" value="{{ $work ->id }}">

                <!-- 头图 -->
                <div class="WriteCover-wrapper">
                    <input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="cover" data-default-file="@if(!empty($topic)){{ $topic ->cover }}@endif"/>
                </div>
                <!-- 标题 -->
                <div class="WriteIndex-titleInput">
                  <input type="text" name="name" placeholder="请输入标题" value="@if(!empty($topic)){{ $topic ->name }}@endif" required/>
                </div>
                <!-- 文章主体 -->
                <div>
                  <textarea id="editor" name="body" rows="8" cols="80" required>@if(!empty($topic)){{ $topic ->body }}@endif</textarea>
                </div>

                <div class="well well-sm">
                  @if(!empty($topic))
                  <button type="submit" class="btn btn-info">点击修改文章</button>
                  @else
                  <button type="submit" class="btn btn-info">点击发表文章</button>
                  @endif
                </div>
              </form>
            </div>
            </div>

            <!--  -->
            <div class="col-xs-4 library">
              <div style="">
                <h4><i class="glyphicon glyphicon-th-list"></i> 目录：</h4>

                <!--  -->
                <ul class="list-group">
                  @foreach($work ->workTopic as $key => $workTopic)
                  <li class="list-group-item">
                    <a href="{{ route('topics.show', $workTopic) }}"><span>{{ $key + 1 }}.</span> {{ $workTopic -> name }}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('dropify/js/dropify.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/module.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/hotkeys.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/uploader.min.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('js/simditor.min.js') }}"></script>

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
</body>
</html>
