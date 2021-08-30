<?php

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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}','PostController@show')->name('post');

Route::middleware('auth')->group(function(){
    Route::get('/admin','AdminController@index')->name('admin.index');

   

    //user profile
    Route::put('/admin/user/{user}/update/profile','UserController@update')->name('user.profile.update');
    
});
Route::middleware(['auth','can:view,user'])->group(function(){

    Route::get('/admin/user/{user}/profile','UserController@show')->name('user.profile');
});

Route::middleware(['role:Admin','auth'])->group(function(){
    Route::get('/admin/users','UserController@index')->name('user.index');
    Route::delete('/admin/user/{user}/destroy','UserController@destroy')->name('user.destroy');

    Route::post('/admin/user/attach/{user}/role','UserController@attachRole')->name('user.attach.role');
    Route::post('/admin/user/detach/{user}/role','UserController@detachRole')->name('user.detach.role');

});



Route::get('create-role',function(){
    $user = App\User::find(21);

    $role =new App\Role;
    $role->name = 'Author';
    $role->slug = 'author';
    $role->save();
    // $user->roles()->attach($role);

    // $permission = new App\Permission();
    // $permission->name = 'View Dashboard';
    // $permission->slug = 'view-dashboard';
    // $permission->save();
    // $user->permissions()->attach($permission);

    // $role->permissions()->attach($permission);
    
});
