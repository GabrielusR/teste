<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    
    Route::get('/home', [
       'uses'  => 'HomeController@index',
        'as' => 'home'
    ]);
    
    Route::get('/users', [
       'uses'  => 'UsersController@index',
        'as' => 'users'
    ]);
    
     Route::get('/users/trash', [
       'uses'  => 'UsersController@trash',
        'as' => 'users.trash'
    ]);
    
    Route::get('/user/create', [
       'uses'  => 'UsersController@create',
        'as' => 'user.create'
    ]);
    
    Route::post('/user/store', [
       'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);
    
    Route::get('user/admin/{id}', [
       'uses' => 'UsersController@admin',
        'as' => 'user.admin'
    ]);
    
     Route::get('user/not-admin/{id}', [
       'uses' => 'UsersController@not_admin',
        'as' => 'user.not.admin'
    ]);
    
    Route::get('/user/delete/{id}', [
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete'
    ]);
    
    Route::get('/user/kill/{id}', [
       'uses'  => 'UsersController@kill',
        'as' => 'user.kill'
    ]);
    
    Route::get('/user/restore/{id}', [
       'uses'  => 'UsersController@restore',
        'as' => 'user.restore'
    ]);
    
    Route::get('user/profile', [
       'uses' => 'ProfilesController@index',
        'as' => 'user.profile'
    ]);
    
    Route::get('user/profile/edit/{id}', [
       'uses' => 'ProfilesController@edit',
        'as' => 'user.profile.edit'
    ]);
    
    Route::post('user/profile/update', [
       'uses' => 'ProfilesController@update',
        'as' => 'user.profile.update'
    ]);
    
    Route::post('user/profile/store', [
       'uses' => 'ProfilesController@store',
        'as' => 'user.profile.store'
    ]);
    
});