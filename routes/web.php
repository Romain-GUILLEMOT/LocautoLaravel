<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\ReservationsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return Redirect::route('admin.dashboard');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::prefix('admin')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.dashboard');


        $controllers = [
            'users' => UsersController::class,
            'invoices' => InvoicesController::class,
            'reservations' => ReservationsController::class,
            'cars' => \App\Http\Controllers\Admin\CarController::class,

        ];

        foreach ($controllers as $resource => $controller) {
            Route::resource($resource, $controller, ['only' => ['index', 'store', 'update', 'destroy']])
                ->names([
                    'index' => "admin.{$resource}.index",
                    'update' => "admin.{$resource}.update",
                    'store' => "admin.{$resource}.store",
                    'destroy' => "admin.{$resource}.destroy"

                ])
                ->missing(function (Request $request) {
                    return Redirect::route('admin.index');
                });
        }

    });

});
