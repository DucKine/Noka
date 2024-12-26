<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Support\Facades\Redis;
use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;

class MenuController extends Controller
{
    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }   
    public function create(){
        return view('admin.menu.add', [
            'title' => 'Them danh muc moi',
            'menus' => $this->menuService->getParent()
        ]);
    }
    public function store(CreateFormRequest $request){
        $this->menuService->create($request);
        return redirect()->back();
    }
    public function index(){
        return view('admin.menu.list', [
            'title' => 'Danh sach danh muc',
            'menus' => $this->menuService->getAll()
        ]);
    }
    public function destroy(Request $request){
        $result = $this->menuService->destroy($request);
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
    public function show(Menu $menus){
        return view('admin.menu.edit', [
            'title' => 'Sua danh muc: '.$menus->name,
            'menus' => $menus,
            'parentMenus' => $this->menuService->getParent()
        ]);
    }
    public function upgrade(Menu $menu, CreateFormRequest $request){
        $this->menuService->upgrade($menu, $request);
        return redirect('/admin/menus/list');
    }
}
