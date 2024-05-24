<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>['auth','isadmin']],function(){
    Route::get('admin/dashboard',[Dashboardcontroller::class,'index'])->name('admin.dashboard');
    Route::prefix('isadmin')->group(function () {



        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

    });
 
    Route::group(['middleware'=>['auth','user']],function(){
        Route::get('user/dashboard',[Dashboardcontroller::class,'userindex'])->name('user.dashboard');
        Route::prefix('user')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    });
    
        });
require __DIR__.'/auth.php';
