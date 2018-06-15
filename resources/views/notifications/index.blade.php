@extends('layouts.app')

@section('content')
<div class="container new-collection">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">

                <h3 class="text-center">
                  我的通知
                </h3>
                <hr>

                @if ($notifications->count())

                    <div class="notification-list">
                        @foreach ($notifications as $notification)
                            @include('notifications.types._' . snake_case(class_basename($notification->type)))
                        @endforeach
                    </div>

                @else
                    <div class="empty-block">
                      @include('commons._empty')
                    </div>
                @endif

            </div>
        </div>
    </div>
  </div>
</div>
@endsection
