<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
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
Route::get('events/check-out/{id}', [HomeController::class, 'checkOut'])->name('events.checkOut');
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::POST('events/{id}/process-transaction', [PaymentController::class, 'processTransaction'])->name('processTransaction');
Route::get('events/{id}/success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('events/{id}/cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');
Route::get('events/{id}/payment-received', [PaymentController::class, 'paymentReceived'])->name('paymentReceived');
Auth::routes();
