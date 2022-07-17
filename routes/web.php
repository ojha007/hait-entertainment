<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');
Route::get('events', [HomeController::class, 'events'])->name('events');
Route::get('events/{id}', [HomeController::class, 'eventDetail'])->name('events.show');
Route::post('events/check-out/{id}', [HomeController::class, 'checkOut'])->name('events.checkOut');
Auth::routes();
