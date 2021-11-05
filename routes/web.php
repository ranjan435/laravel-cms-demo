<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
    return view('home');
});

Route::get('/login', function(){
    return view('login');
});
Route::post('/login', [UserController::class,'login']);
Route::view('/register','register');
Route::post('/register',[UserController::class,'register']);
Route::get('/logout',function(){
    Session::forget('user');
    return redirect('login');
});
Route::get('/profile',[UserController::class,'profile']);
Route::post('/updateprofile',[UserController::class,'updateProfile']);

Route::get('/user/add',function(){
    return view('addUser');
});
Route::post('/user/addUser',[UserController::class, 'addUser']);

//DATATABLES
Route::get('users',[UserController::class, 'index']);
Route::get('users/list',[UserController::class,'getUsers'])->name('users.list');

Route::get('/user/{id}',[UserController::class, 'getUser'])->name('user/{id}');
Route::post('/editUser',[UserController::class, 'editUser']);
Route::post('/user/delete/{id}',[UserController::class, 'deleteUser']);

//POST
Route::get('/post/create',function(){
    return view('createPost');
});
Route::post('/post/create',[PostController::class, 'createPost']);
Route::get('/post/{id}',[PostController::class, 'getPost']);
Route::post('/update',[PostController::class, 'updatePost']);
Route::get('/delete/{id}',[PostController::class, 'deletePost']);
//datatables
Route::get('posts',[PostController::class ,'index']);
Route::get('posts/list',[PostController::class, 'getPosts'])->name('posts.list');

Route::get('/dashboard',[PostController::class, 'dashboard']);

Route::get('/home',function(){
    return view('home');
});
Route::get('/postdetail/{id}',[PostController::class, 'postdetail']);