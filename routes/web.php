<?php

use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PhotosController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UsersPermissionsController;
use App\Http\Controllers\Admin\UsersRolesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController as ControllersPostsController;
use App\Http\Controllers\TagsController;
use App\Mail\LoginCredentials;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[PagesController::class, 'home'])->name('pages.home');
Route::get('about',[PagesController::class, 'about'])->name('pages.about');
Route::get('archive',[PagesController::class, 'archive'])->name('pages.archive');
Route::get('contact',[PagesController::class, 'contact'])->name('pages.contact');


Route::get('blog/{post}',[ControllersPostsController::class, 'show'])->name('posts.show');
Route::get('categories/{category}',[CategoriesController::class, 'show'])->name('categories.show');
Route::get('tags/{tag}',[TagsController::class, 'show'])->name('tags.show');

Route::group([
    'prefix'=>'admin',
    'middleware'=>'auth'],
    function(){
        Route::get('/',[AdminController::class, 'index'])->name('admin');

        Route::resource('posts',PostsController::class,['except'=>'show' , 'as' => 'admin']);
        Route::resource('users',UsersController::class,['as' => 'admin']);
        Route::resource('roles',RolesController::class,['except'=>'show','as' => 'admin']);
        Route::resource('permissions',PermissionsController::class,['only'=>['index','edit','update'],'as' => 'admin']);

        //Route::middleware('role:Admin')->
        Route::middleware('role:Admin')->put('users/{user}/roles',[UsersRolesController::class, 'update'])->name('admin.users.roles.update');

        Route::middleware('role:Admin')->put('users/{user}/permissions',[UsersPermissionsController::class,'update'])->name('admin.users.permissions.update');

        Route::post('posts/{post}/photos', [PhotosController::class, 'store'])->name('admin.posts.photos.store');
        Route::delete('photos/{photo}',[PhotosController::class, 'destroy'])->name('admin.photos.destroy');
        // Route Administracion

});


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login',[LoginController::class, 'login']);
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('password/reset',[ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email',[ForgotPasswordController::class, 'ResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',[ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset',[ResetPasswordController::class, 'reset'])->name('password.update');





