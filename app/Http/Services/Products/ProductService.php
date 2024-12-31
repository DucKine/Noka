<?php


namespace App\Http\Services\Products;

use Exception;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductService
{
    const LIMIT = 16;
    public function get($page = null)
    {
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->orderByDesc('id')
            ->offset(10)
            ->limit(self::LIMIT)
            ->get();
    }
    public function show($id){
        return Product::where('id', $id)
        ->where('active', 1)
        ->with('menu')
        ->firstOrFail();
    }
}
