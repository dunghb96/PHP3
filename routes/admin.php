<?php

use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
// Route::post('upload_file/{dirname}',[UploadController::class,'saveUpload'])->name('upload.savefile');
Route::prefix('room')->group(function(){
    Route::get('/',                [RoomController::class, 'index'])   ->name('room.list');
    Route::get('/add',             [RoomController::class, 'add'])     ->middleware('auth','permission:add rooms')->name('room.add');
    Route::post('/add',            [RoomController::class, 'addNew']);
    Route::get('/edit/{id}',       [RoomController::class, 'edit'])    ->middleware('auth','permission:edit rooms')->name('room.edit');
    Route::post('/edit/{id}',      [RoomController::class, 'saveEdit']);
    Route::get('/remove/{id}',     [RoomController::class, 'remove'])  ->middleware('auth','permission:remove rooms')->name('room.remove');
});
Route::prefix('user')->group(function(){
    Route::get('/',                [UserController::class, 'index'])   ->name('user.list');
    Route::get('/add',             [UserController::class, 'add'])     ->middleware('auth','permission:add users')->name('user.add');
    Route::post('/add',            [UserController::class, 'addNew']);
    Route::get('/edit/{id}',       [UserController::class, 'edit'])    ->middleware('auth','permission:edit users')->name('user.edit');
    Route::post('/edit/{id}',      [UserController::class, 'saveEdit']);
    Route::get('/edit-pass/{id}',  [UserController::class, 'edit_pass'])->middleware('auth')->name('user.edit-pass');
    Route::post('/edit-pass/{id}', [UserController::class, 'saveNewPass']);
    Route::get('/remove/{id}',     [UserController::class, 'remove'])  ->middleware('auth','permission:remove users')->name('user.remove');
});
Route::prefix('service')->group(function(){
    Route::get('/',                [ServiceController::class, 'index'])->name('service.list');
    Route::get('/add',             [ServiceController::class, 'add'])->middleware('auth','permission:add services')->name('service.add');
    Route::post('/add',            [ServiceController::class, 'store']);
    Route::get('/edit/{id}',       [ServiceController::class, 'edit'])->middleware('auth','permission:edit services')->name('service.edit');
    Route::post('/edit/{id}',      [ServiceController::class, 'saveEdit']);
    Route::get('/remove/{id}',     [ServiceController::class, 'remove'])->middleware('auth','permission:remove services')->name('service.remove');
});
Route::prefix('permission')->group(function(){
    Route::get('/',                [PermissionController::class, 'index'])->name('permission.list');
    Route::get('/add',             [PermissionController::class, 'create'])->middleware('auth','permission:add permissions')->name('permission.add');
    Route::post('/add',            [PermissionController::class, 'store']);
    Route::get('/edit/{id}',       [PermissionController::class, 'edit'])->middleware('auth','permission:edit permissions')->name('permission.edit');
    Route::post('/edit/{id}',      [PermissionController::class, 'update']);
    Route::get('/remove/{id}',     [PermissionController::class, 'remove'])->middleware('auth','permission:remove permissions')->name('permission.remove');
});
Route::prefix('role')->group(function(){
    Route::get('/',                [RoleController::class, 'index'])->name('role.list');
    Route::get('/add',             [RoleController::class, 'add'])->middleware('auth','permission:add roles')->name('role.add');
    Route::post('/add',            [RoleController::class, 'store']);
    Route::get('/edit/{id}',       [RoleController::class, 'edit'])->middleware('auth','permission:edit roles')->name('role.edit');
    Route::post('/edit/{id}',      [RoleController::class, 'update']);
    Route::get('/remove/{id}',     [RoleController::class, 'remove'])->middleware('auth','permission:remove roles')->name('role.remove');
});



