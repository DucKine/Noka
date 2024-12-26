<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Products\ProductService;
use App\Http\Services\Slider\SliderAdminService;
use Illuminate\Http\Request;

class UserMainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(MenuService $menu, SliderAdminService $slider, ProductService $product)
    {
        $this->menu = $menu;
        $this->slider = $slider;
        $this->product = $product;
    }

    public function index()
    {

        return view('main', [
            'title' => 'Elysia Realm',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get()
        ]);
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
    }
}
