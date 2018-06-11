@extends('admin.layouts.app')

@section('content')
  <div>

    @include('commons._message')

    <form action="/admin/roles/{{$role->id}}/permission" method="POST">
          {{csrf_field()}}
          <div class="form-group">
              @foreach($permissions as $permission)
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="permissions[]"
                                 @if ($myPermissions->contains($permission))
                                 checked
                                 @endif
                                 value="{{$permission->id}}">
                          {{$permission->name}}
                      </label>
                  </div>
              @endforeach
          </div>
          <div class="box-footer">
              <button type="submit" class="btn btn-primary">提交</button>
          </div>
      </form>

  </div>
@endsection
