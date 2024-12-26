<?php

namespace App\Http\Services;

use Exception;

class UploadService
{
    public function store($request){
        try{
            if($request -> hasFile('file')){
                $name = $request->file('file')->getClientOriginalName();
                $pathFull = 'uploads/'. date("y/m/d");
                $path = $request->file('file')->storeAs(
                    'public/'.$pathFull, $name
                );
            }
            return '/storage/'.$pathFull .'/'.$name;
        }catch(Exception $e){
            return false;
        }
        
    }
}