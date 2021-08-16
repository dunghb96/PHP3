<?php

// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Doctrine\DBAL\Schema\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('welcome');
});

// Route::get('room', [RoomController::class, 'index']);
// Route::get('service', [ServiceController::class, 'index']);
// Route::get('user',[UserController::class,'index']);

// Route::get('/',function(){
//     return view('admin.layouts.main');
// });
Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('login',[LoginController::class,'postLogin']);
Route::get('register',[LoginController::class,'register'])->name('register');
Route::post('register',[LoginController::class,'registerAdd']);
Route::any('logout',function (){
    Auth::logout();
    return redirect(route('login'));
})->name('logout');

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// Route::get('config/prepare-role-n-permission',function(){
//     Role::create(['name'=>'admin']);
//     Role::create(['name'=>'editor']);
//     Role::create(['name'=>'moderato']);

//     Permission::create(['name'=>'add product']);
//     Permission::create(['name'=>'edit product']);
//     Permission::create(['name'=>'remove product']);

//     $adminRole=Role::find(1);
//     $editRole=Role::find(2);
//     $modRole=Role::find(3);

//     $addProPer=Permission::find(1);
//     $editProPer=Permission::find(2);
//     $removeProPer=Permission::find(3);

//     $adminRole->givePermissionTo($addProPer);
//     $adminRole->givePermissionTo($editProPer);
//     $adminRole->givePermissionTo($removeProPer);

//     $editRole->givePermissionTo($addProPer);
//     $editRole->givePermissionTo($editProPer);

//     $modRole->givePermissionTo($removeProPer);
//     // tài khoản id = 1 là admin
//     $adminAcc=User::find(1);
//     $adminAcc->assignRole('admin');

//     //  tài khoản id = 2 là admin
//     $editorAcc=User::find(2);
//     $editorAcc->assignRole('editor');

//     // tải khoản id = 23 là mod
//     $modAcc=User::find(5);
//     $modAcc->assignRole('moderato');
//     return 'done';
// });
