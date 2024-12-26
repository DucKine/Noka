<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Exception;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MenuService
{
    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }
    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }
    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name'), '-')
            ]);
            Session::flash('success', 'Them thanh cong');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
    }

    public function upgrade($menu, $request)
    {
        try {
            if ($request->input('parent_id') != $menu->id) {
                $menu->parent_id = (int)$request->input('parent_id');
            }
            $menu->name = (string) $request->input('name');
            $menu->parent_id = (string) $request->input('parent_id');
            $menu->description = (string) $request->input('description');
            $menu->content = (string) $request->input('content');
            $menu->active = (string) $request->input('active');
            $menu->save();
            Session::flash('success', 'Cap nhat thanh cong');
            return true;
        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function show() {
        return Menu::select('name', 'id')->where('parent_id', 0)->orderbyDesc('id')->get();
    }



    // public function update($menu, $request)
    // {
    //     try {
    //         $menu->update([
    //             'title' => (string)$request->input('name'),
    //             'parent_id' => (int)$request->input('parent_id'),
    //             'description' => (string)$request->input('description'),
    //             'content' => (string)$request->input('content'),
    //             'active' => (bool)$request->input('active'),
    //             'slug' => Str::slug($request->input('name'), '-'),
    //         ]);

    //         return true;
    //     } catch (Exception $e) {
    //         \Log::error($e->getMessage());
    //         return false;
    //     }
    // }
}
