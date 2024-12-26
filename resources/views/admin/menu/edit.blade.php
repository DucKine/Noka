@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content') 
<form action="" method="POST">
    <div class="card-body">
      <div class="form-group">
        <label for="menu">Ten danh muc</label>
        <input type="text" name="name" value="{{$menus->name}}" class="form-control" id="menu">
      </div>
      <div class="form-group">
        <label for="menu">Danh mục</label>
        <select class="form-control" name="parent_id">
            <option value="0" {{ $menus->parent_id == 0 ? 'selected' : '' }}>Danh mục 1</option>
            @foreach($parentMenus as $menuParent) 
                <option value="{{ $menuParent->id }}" 
                    {{ $menus->parent_id == $menuParent->id ? 'selected' : '' }}>
                    {{ $menuParent->name }}
                </option>
            @endforeach
        </select>
    </div>
      <div class="form-group">
        <label>Mo ta ngan</label>
        <textarea name="description" class="form-control">{{$menus->description}}</textarea>
      </div>
      <div class="form-group">
        <label>Mo ta chi tiet</label>
        <textarea name="content" id="content" class="form-control">{{$menus->content}}</textarea>
      </div>
    </div>
    <div class="form-group">
        <label>Kich hoat</label>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" value="1" id="active" name="active"
            {{$menus->active == 1 ? 'checked =""': ''}} >
            <label for="active" class="custom-control-label">Online</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" value="0" id="nonactive" name="active"
            {{$menus->active == 0 ? 'checked =""': ''}}>
            <label for="nonactive" class="custom-control-label">Offline</label>
          </div>
      </div>
{{-- </div> --}}
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Cap nhat danh muc</button>
    </div>
    @csrf
  </form>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection