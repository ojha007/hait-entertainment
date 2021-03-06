<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarousalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'web'], 'prefix' => 'internal', 'as' => 'internal.'], function ($route) {
    $route->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    $route->resource('events', EventController::class);
    $route->get('bookings/{token}/checkIn', [BookingController::class, 'checkIn'])->name('bookings.checkIn');
    $route->resource('bookings', BookingController::class);

    $route->group(['middleware' => 'isAdmin'], function ($route) {
        $route->resource('carousals', CarousalController::class);
        $route->resource('users', UserController::class);
    });

    $route->group(['as' => 'master.', 'prefix' => 'master', 'middleware' => 'isAdmin'], function ($router) {
        $router->resource('tickets', TicketController::class);
        $router->resource('event-types', EventTypeController::class);
        $router->resource('partners', PartnerController::class, ['expect' => 'update', 'edit', 'show']);
    });
});
