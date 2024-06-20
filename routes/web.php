<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\usersController;
use Faker\Guesser\Name;
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



/**notices*/
Route::get('/notices',[Admincontroller::class,'noticeindex'])->name('admin.notices.index');
Route::get('/notices/create',[Admincontroller::class,'noticecreate'])->name('admin.notices.create');
Route::post('/notices/store',[Admincontroller::class,'noticestore'])->name('admin.notices.store');
Route::get('/notices/{id}/edit',[Admincontroller::class,'noticeedit'])->name('admin.notices.edit');
Route::post('/notice/{id}/update',[Admincontroller::class,'noticeupdate'])->name('admin.notices.update');
Route::get('/notice/{id}/delete',[Admincontroller::class,'noticedelete'])->name('admin.notices.delete');
   /**meetings */

   Route::get('/meetings',[Admincontroller::class,'meetingindex'])->name('admin.meetings.index');
Route::get('/meetings/create',[Admincontroller::class,'meetingcreate'])->name('admin.meetings.create');
Route::post('/meeting/store',[Admincontroller::class,'meetingstore'])->name('admin.meetings.store');
Route::get('/meetings/{id}/edit',[Admincontroller::class,'meetingedit'])->name('admin.meetngs.edit');
Route::post('/meetings/{id}/update',[Admincontroller::class,'meetingupdate'])->name('admin.meetings.update');
Route::get('/meetings/{id}/delete',[Admincontroller::class,'meetingdelete'])->name('admin.meetings.delete');
   
/*******************manageuser********* */
Route::get('/manageusers',[Admincontroller::class,'manageuserindex'])->name('admin.manageusers.index');
Route::get('manageusers/create',[Admincontroller::class,'manageusercreate'])->name('admin.manageusers.create');
Route::post('/manageuser/store',[Admincontroller::class,'manageuserstore'])->name('admin.manageusers.store');
Route::get('/manageusers/{id}/edit', [Admincontroller::class, 'manageuseredit'])->name('admin.manageusers.edit');
Route::post('/manageusers/{id}/update', [Admincontroller::class, 'manageuserupdate'])->name('admin.manageusers.update');
Route::get('/manageusers/{id}/delete', [Admincontroller::class, 'manageuserdelete'])->name('admin.manageusers.delete');

Route::prefix('isadmin')->group(function () {
        Route::get('/profile', [Admincontroller::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile', [Admincontroller::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [Admincontroller::class, 'destroy'])->name('admin.profile.destroy');
   });

    });


    /********************user dashoard******************************************/
 
    Route::group(['middleware'=>['auth','user']],function(){
        Route::get('user/dashboard',[Dashboardcontroller::class,'userindex'])->name('user.dashboard');

     
        Route::get('user/meetings',[usersController::class,'meetingindex'])->name('user.meeting.index');
        Route::get('user/agenda',[usersController::class,'agenda'])->name('agenda');
        Route::get('user/notice',[usersController::class,'notice'])->name('notice');



        Route::prefix('user')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    });
    
        });
require __DIR__.'/auth.php';
