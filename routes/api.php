<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\EventInvoicesController;
use App\Http\Controllers\Api\CustomerEventsController;
use App\Http\Controllers\Api\CustomerInvoicesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('menus', MenuController::class);

        Route::apiResource('customers', CustomerController::class);

        // Customer Events
        Route::get('/customers/{customer}/events', [
            CustomerEventsController::class,
            'index',
        ])->name('customers.events.index');
        Route::post('/customers/{customer}/events', [
            CustomerEventsController::class,
            'store',
        ])->name('customers.events.store');

        // Customer Invoices
        Route::get('/customers/{customer}/invoices', [
            CustomerInvoicesController::class,
            'index',
        ])->name('customers.invoices.index');
        Route::post('/customers/{customer}/invoices', [
            CustomerInvoicesController::class,
            'store',
        ])->name('customers.invoices.store');

        Route::apiResource('events', EventController::class);

        // Event Invoices
        Route::get('/events/{event}/invoices', [
            EventInvoicesController::class,
            'index',
        ])->name('events.invoices.index');
        Route::post('/events/{event}/invoices', [
            EventInvoicesController::class,
            'store',
        ])->name('events.invoices.store');

        Route::apiResource('settings', SettingController::class);

        Route::apiResource('users', UserController::class);

        Route::apiResource('invoices', InvoiceController::class);
    });
