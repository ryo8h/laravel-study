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


/** make:authにより生成されたルート */
Auth::routes();

/** User 認証不要 */
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    }
    return view('welcome');
});

/** User ログイン後 */
Route::group(['middleware' => 'auth:user'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    /** プロフィールページページへのルート */
    Route::get('/home/profile', 'UserController@show')->name('profile');
    /** プロフィール編集ページへのルート */
    Route::get('/home/profile/edit', 'UserController@index')->name('editProfile');
    Route::post('/home/profile/edit', 'UserController@update')->name('editProfile');
    /** 投稿ルート */
    Route::post('/home/post', 'PostController@postMessage')->name('post');
});

/** Admin 認証不要 */
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

/** Admin ログイン後 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@index')->name('admin.home');
    /** アカウントリストページへのルート */
    Route::get('home/userList',   'Admin\UserController@showAll')->name('admin.userList');
    Route::post('home/userList',   'Admin\UserController@deleteUser')->name('deleteUser');
    /** ユーザのプロフィール */
    Route::get('/home/profile', 'Admin\UserController@show')->name('admin.profile');
    Route::post('home',   'Admin\PostController@deletePost')->name('deletePost');
});

