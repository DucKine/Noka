@extends('admin.main')
@section('content') 
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ten Slider</th>
                <th>Duong dan</th>
                <th>Anh</th>
                <th>Active</th>
                <th>Update</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $key => $slider)
                
            
            <tr>
                <td>{{$slider->id}}</td>
                <td>{{$slider->name}}</td>
                <td>{{$slider->url}}</td>
                <td><a href="{{$slider->thumb}}" target="_blank"><img src="{{$slider->thumb}}" height="40px" alt=""></a></td>  
                <td>{!!App\Helper\Helper::active($slider->active)!!}</td>  
                <th>{{$slider->updated_at}}</th> 
                <td>
                    <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection