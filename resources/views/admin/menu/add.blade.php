@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content') 
<form action="" method="POST">
    <div class="card-body">
      {{-- @if(session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
      @endif
      @if(session()->has('success'))
          <div class="alert alert-success">
              {{session()->get('success')}}
          </div>
      @endif --}}
      <div class="form-group">
        <label for="menu">Ten danh muc</label>
        <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="menu">Danh muc</label>
        <select class="form-control" name="parent_id">
            <option value="0">Danh muc1</option>
            @foreach($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->name}}</option>

            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Mo ta ngan</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label>Mo ta chi tiet</label>
        <textarea name="content" id="content" class="form-control"></textarea>
      </div>
    </div>
    {{-- <div class="form-group">
      <label>Anh san pham</label>
      <input type="file" name="file" class="form-control" id="upload">
      <div id="image_show"></div>
      <input type="hidden" name="file" id="file">
    </div> --}}
    <div class="form-group">
        <label>Kich hoat</label>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked ="">
            <label for="active" class="custom-control-label">Online</label>
          </div>
          <div class="custom-control custom-radio">
            <input class="custom-control-input" type="radio" value="0" id="nonactive" name="active">
            <label for="nonactive" class="custom-control-label">Offline</label>
          </div>
      </div>
{{-- </div> --}}
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tao</button>
    </div>
    @csrf
  </form>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection