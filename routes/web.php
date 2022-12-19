<?php

use Illuminate\Support\Facades\Route;
use Dcblogdev\Dropbox\Facades\Dropbox;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\admin\HomeDashboardController;
use App\Http\Controllers\admin\PropertyVillaController;
use App\Http\Controllers\admin\CategoriesPropertyController;
use App\Http\Controllers\admin\PropertyFeaturesController;
use App\Http\Controllers\admin\PropertyGalleryController;
use App\Http\Controllers\LoginController;
use App\Models\PropertyVilla;

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

Route::get('/', [HomepageController::class, 'index']);
Route::get('/property/{properties_villa}', [HomepageController::class, 'propertyDetail'])->name('frontend-property-detail');
Route::get('/properties', [HomepageController::class, 'properties'])->name('properties-list');

Route::get('/login', [LoginController::class, 'index'])->name("login")->middleware('guest');
Route::get('/register', [LoginController::class, 'register'])->name("register");
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth-login');
Route::post('/register', [LoginController::class, 'authRegistration'])->name('auth-register');
Route::post('/logout', [LoginController::class, 'authLogout'])->name('auth-logout');

Route::prefix("admin")->middleware('auth')->group(function () {
    Route::get("dashboard", [HomeDashboardController::class, "index"])->name("dashboard");
    Route::resource("properties-villa", PropertyVillaController::class);
    Route::resource("categories-property", CategoriesPropertyController::class);
    Route::resource('properties-gallery', PropertyGalleryController::class);
    Route::resource('properties-feature', PropertyFeaturesController::class);
});
