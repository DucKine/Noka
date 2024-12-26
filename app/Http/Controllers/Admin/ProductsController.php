<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Services\Products\ProductAdminService;
use App\Models\Product;

class ProductsController extends Controller
{
    protected $productService;
    public function __construct(ProductAdminService $productService){
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh sach san pham',
            'products' => $this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Them san pham',
            'menus' => $this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'title' => 'Chinh sua san pham',
            'product' => $product,
            'menus' => $this->productService->getMenu() 
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if($result){
            return redirect('/admin/product/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
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
