@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <div class="">
      <form class="" action="{{ route('admin.users.storeRole', $user) }}" method="post">
        {{ csrf_field() }}

        @foreach($roles as $role)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="roles[]"
                           @if ($myRoles->contains($role))
                           checked
                           @endif
                           value="{{$role->id}}">
                    {{$role->name}}
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">提交</button>
      </form>
    </div>

  </div>
@endsection
