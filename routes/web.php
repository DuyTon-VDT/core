<?php

use Illuminate\Support\Facades\Route;
use LaraPlatform\Core\Facades\Core;
use LaraPlatform\Core\Loader\OptionLoader;
use LaraPlatform\Core\Supports\BaseScan;

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

Route::group(['prefix' => 'lara', 'middleware' => ['web']], function () {
    Route::post('/livewire/component/{slug}', [LaraPlatform\Core\Http\Controllers\LaraServiceController::class, 'loadComponent']);
});

Route::group(['prefix' => Core::adminPrefix(), 'middleware' => ['web']], function () {
    Route::get('/', LaraPlatform\Core\Http\Livewire\Page\Dashboard\Index::class)->name('admin.dashboard');
    Route::get('/table/{module}', LaraPlatform\Core\Http\Livewire\Table\Index::class)->name('admin.table.slug');
    Route::get('/option', LaraPlatform\Core\Http\Livewire\Page\Option\Index::class)->name('admin.option');
    do_action('register_route_admin');
});
Route::group(['middleware' => ['web']], function () {
    Route::get(apply_filters('route_page_login_url','login'),apply_filters('route_page_login_component',LaraPlatform\Core\Http\Livewire\Page\Auth\Login::class))->name('core.login');

    Route::get(apply_filters('route_page_register_url','register'),apply_filters('route_page_register_component',LaraPlatform\Core\Http\Livewire\Page\Auth\Register::class))->name('core.register');
    
});
