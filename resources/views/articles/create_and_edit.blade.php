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
        <div class="container article">
          <div class="row">
            <div class="article-main">

              @if($article ->id)
              <form action="http://www.myworld.com/articles/{{$article ->id}}" method="post" style="display: inline-block;">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-default pull-right" style="margin-bottom: 15px;">删除文章</button>
              </form>
              @endif

              @if($article ->id)
              <form class="" action="{{ route('articles.update', $article) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PUT">
              @else
              <form class="" action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
              @endif
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                <!-- 文章分类 -->
                <div class="article-type">
                  <p>选择合适的分类，能方便分类检索，文章也更容易让读者发现。</p>
                  <div class="type-list clearfix">
                    <!--  -->
                    @foreach($categories as $category)
                    <div class="type-item pull-left" data-id="{{ $category ->id }}">
                      <label for="category_{{ $category ->id }}">
                        <input id="category_{{ $category ->id }}" type="radio" name="category_id" value="{{ $category ->id }}" @if($category ->id == $article ->category_id) checked @endif required/>
                        <span>{{ $category ->name }}</span>
                      </label>
                    </div>
                    @endforeach
                  </div>
                </div>

                <!-- 头图 -->
                <div class="WriteCover-wrapper">
                    <input type="file" id="input-file-now-custom-2" class="dropify" data-height="300" name="cover" data-default-file="{{ $article ->cover }}"/>
                </div>

                <!-- 标题 -->
                <div class="WriteIndex-titleInput">
                  <input type="text" name="title" placeholder="请输入标题" value="{{ $article ->title }}" required/>
                </div>

                <!-- 文章主体 -->
                <div>
                  <textarea id="editor" name="body" rows="8" cols="80" required>{{ $article ->body }}</textarea>
                </div>

                <!-- 标签 -->
                <div class="WriteIndex-titleInput">
                  <input type="text" name="tags" placeholder="请输入文章标签以分号分割，例如：好文章;盛世好文" value="@if(!empty($tagNames)) {{ $tagNames }} @endif"/>
                </div>

                <div class="well well-sm">
                  @if($article ->id)
                  <button type="submit" class="btn btn-info">点击编辑文章</button>
                  @else
                  <button type="submit" class="btn btn-info">点击发表文章</button>
                  @endif
                </div>
              </form>
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
