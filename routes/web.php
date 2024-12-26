<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
//use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Controllers\Admin\MenuController;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\UserMainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store', [LoginController::class, 'store']);

#menu
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('/main', [MainController::class, 'index']);
        Route::prefix('/menus')->group(function () {
            Route::get('/add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'upgrade']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });

        Route::prefix('/product')->group(function () {
            Route::get('/add', [ProductsController::class, 'create']);
            Route::post('add', [ProductsController::class, 'store']);
            Route::get('list', [ProductsController::class, 'index']);
            Route::get('edit/{products}', [ProductsController::class, 'show']);
            Route::post('edit/{products}', [ProductsController::class, 'update']);
            Route::DELETE('destroy', [ProductsController::class, 'destroy']);
        });

        Route::prefix('/sliders')->group(function () {
            Route::get('/add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [UserMainController::class, 'index']);  
Route::post('/service/load-product', [MainController::class, 'loadProduct']);
//Route::get('/', [MainController::class, 'index']);


//Route::get('/admin/home', [MainController::class, 'index'] )->name('admin')->middleware('auth');