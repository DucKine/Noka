<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderAdminService;

class MainController extends Controller
{
    protected $slider;
   

    public function __construct(SliderAdminService $slider)
    {
        $this->slider = $slider;
       
    }

    public function index(){
        return view('admin.home', [
            'title' => "Trang chu Admin",
            'sliders' => $this->slider->show(),
           
        ]);
    }
}
