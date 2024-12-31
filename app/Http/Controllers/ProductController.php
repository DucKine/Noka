<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Products\ProductService;
use App\Http\Services\Slider\SliderAdminService;

class ProductController extends Controller
{
    protected $productService;
    protected $slider;
    public function __construct(ProductService $productService, SliderAdminService $slider)
    {
        $this->slider = $slider;
        $this->productService = $productService;
    }

    public function index($id = '', $slug = '')
    {
        $product = $this->productService->show($id);
        $productm = $this->productService->get();
        return view('products.content', [
            'title' => $product->name,
            'sliders' => $this->slider,
            'product' => $product,
            'products' => $productm
        ]);
    }
}
