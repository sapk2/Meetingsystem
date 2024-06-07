<?php

use App\Http\Controllers\Admincontroller;
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
  
   Route::get('/agendas',[Admincontroller::class,'agendaindex'])->name('admin.agendas.index');
   Route::get('/agendas/create',[Admincontroller::class,'agendacreate'])->name('admin.agendas.create');
   Route::post('/agenda/store',[Admincontroller::class,'agendastore'])->name('admin.agendas.store');
   Route::get('/agenda/{id}/edit',[Admincontroller::class,'agendaedit'])->name('admin.agendas.edit');
   Route::post('/agenda/{id}/update',[Admincontroller::class,'agendaupdate'])->name('admin.agendas.update');
   Route::get('/agenda/{id}/delete',[Admincontroller::class,'agendadelete'])->name('admin.agendas.delete');





   /**meetings */

   Route::get('/meetings',[Admincontroller::class,'meetingindex'])->name('admin.meetings.index');
Route::get('/meetings/create',[Admincontroller::class,'meetingcreate'])->name('admin.meetings.create');
Route::post('/meeting/store',[Admincontroller::class,'meetingstore'])->name('admin.meetings.store');
Route::get('/meetings/{id}/edit',[Admincontroller::class,'meetingedit'])->name('admin.meetngs.edit');
Route::post('/meetings/{id}/update',[Admincontroller::class,'meetingupdate'])->name('admin.meetings.update');
Route::get('/meetings/{id}/delete',[Admincontroller::class,'meetingdelete'])->name('admin.meetings.delete');
   
    Route::prefix('isadmin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
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
