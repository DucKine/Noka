<?php

namespace App\Http\Services\Slider;

use Exception;
use App\Models\Slider;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderAdminService
{

    public function insert($request)
    {
        try {
            #$request->except('_token');
            Slider::create($request->input());
            session()->flash('success', 'Them thanh cong Slider');
        } catch (Exception $err) {
            session()->flash('error', 'Them that bai, hay thu lai voi Slider khac');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    public function get()
    {
        return Slider::orderByDesc('id')->paginate(20);
    }

    public function update($request, $slider)
    {

        try {
            $slider->fill($request->input());
            $slider->save();
            session()->flash('success', 'Cap nhat thanh cong');
        } catch (Exception $e) {
            session()->flash('error', 'Co loi, vui long thu lai sau!');
            Log::info($e->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }
    public function show() {
        return Slider::where('active', 1)->orderByDesc('sort_by')->get();
    }
}
