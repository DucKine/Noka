<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Products\ProductService;
use App\Http\Services\Slider\SliderAdminService;

class UserMenuController extends Controller
{
    protected $menuService;
    protected $slider;
    public function __construct(MenuService $menuService, SliderAdminService $slider)
    {
        $this->menuService = $menuService;
        $this->slider = $slider;
    }
    public function index(Request $request, $id, $slug ='')
    {
        $menu = $this->menuService->getID($id);
        $products = $this->menuService->getProduct($menu, $request);
        return view('menu', [
            'title' => 'Herrschers of Human Ego',
            //'sliders' => $this->slider->show(),
            'sliders' => $this->slider,
            'menus' => $this->menuService,
            'products' => $products
        ]);
    }
}
