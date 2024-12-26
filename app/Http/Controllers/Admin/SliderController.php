<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderAdminService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderAdminService $slider)
    {
        $this->slider = $slider;
    }

    public function create(){
        return view('admin.slider.add', [
            'title' => 'Them slide moi'
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'thumb' => 'required',
            'url' => 'required'
        ]);
        $this->slider->insert($request);
        return redirect()->back();    
    }

    public function index(){
        return view('admin.slider.list',[
            'title' => 'Danh sach Slider',
            'sliders' => $this->slider->get()
        ]);
    }
    
    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => 'Chinh sua slider',
            'slider' => $slider,
        ]);
    }
    public function update(Request $request, Slider $slider){
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'thumb' => 'required'
        ]);
        $result = $this->slider->update($request, $slider);
        if($result){
            return redirect('admin/sliders/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoa thanh cong'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
