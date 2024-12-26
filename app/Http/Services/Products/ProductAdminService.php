<?php


namespace App\Http\Services\Products;

use Exception;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductAdminService
{
    public function getMenu(){
        return Menu::where('active', 1)->get();
    }

    public function isValidPrice($request){
        if($request->input('price') != 0 && $request->input('price_sale') != 0 && $request->input('price_sale') >=$request->input('price')){
            session()->flash('error', 'Gia giam phai nho hon gia goc');
            return false;
        }elseif($request->input('price_sale') !=0 && (int)$request->input('price') == 0){
            session()->flash('error', 'Vui long nhap gia goc');
            return false;
        }
        return true;
    }

    public function get(){
        return Product::with('menu')->orderByDesc('id')->paginate(10);
    }
    public function insert($request){
        $isValidPrice = $this-> isValidPrice($request);
        if($isValidPrice == false) return false;
        try{
            #$request->except('_token');
            Product::create($request->all());
            session()->flash('success', 'Them san pham thanh cong');
        }catch(Exception $err){
            session()->flash('error', 'Them san pham that bai');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function update($request, $product){
        $isValidPrice = $this-> isValidPrice($request);
        if($isValidPrice == false) return false;
        try{
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Cap nhat san pham thanh cong');
        }catch(Exception $e){
            session()->flash('error', 'Co loi, vui long thu lai sau!');
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request){
        $product = Product::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }
        return false;
    }
}