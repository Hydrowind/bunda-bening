<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SitemapController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FileUploadController;
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

// Client Route
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('product', [PageController::class, 'product'])->name('product');
Route::get('blog', [PageController::class, 'blog'])->name('blog');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('detail/product/{id}', [PageController::class, 'detail_product'])->name('detail.product');
Route::get('detail/blog/{id}', [PageController::class, 'detail_blog'])->name('detail.blog');
// Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// // Authentication Route
// Route::controller(AuthController::class)->group(function() {
//   Route::get('login', 'login')->name('login');
//   Route::post('signin', 'signin')->name('signin');
//   Route::get('signout', 'signout')->name('signout');
// });

// Admin Route
// Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin']], function(){
//   Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//   Route::resources([
//       'user'      => UserController::class,
//       'product'   => ProductController::class,
//       'post'      => PostController::class,
//       'fileupload'=> FileUploadController::class,
//   ]);

//   Route::resource('users', UserController::class)->middleware('superadmin');

//   Route::group(['prefix' => 'config'], function(){
//     Route::get('/', [ConfigurationController::class, 'index'])->name('admin.config');
//     Route::put('/', [ConfigurationController::class, 'update'])->name('config.update');
//     Route::get('/homepage', [ConfigurationController::class, 'homepage'])->name('admin.config.homepage');
//     Route::put('/partner', [ConfigurationController::class, 'updatePartnerNGuestDoc'])->name('admin.config.partner');
//     Route::put('/homepage', [ConfigurationController::class, 'updateHomeSection'])->name('admin.config.homesection');
//   });
// });