<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::prefix('customers')->middleware(['auth', 'verified'])->controller(CustomersController::class)->group(function () {
    Route::get('/', 'index')->name('customers');
    Route::get('/search', 'search')->name('customers.search');
    Route::get('/create', 'create')->name('customers.create');
    Route::post('/create', 'store')->name('customer.store');
    Route::get('/{id}', 'show')->name('customers.show');
    Route::get('/{id}/edit', 'edit')->name('customers.edit');
    Route::patch('/{id}', 'update')->name('customer.update');
    Route::delete('/{id}', 'destroy')->name('customer.destroy');
});


Route::post('/customers/{id}/add-invoice', [InvoiceController::class, 'store'])->middleware(['auth', 'verified'])->name('invoice.store');
Route::get('/customers/{id}/add-invoice', [InvoiceController::class, 'upload'])->middleware(['auth', 'verified'])->name('customers.add-invoice');

Route::prefix('invoice')->middleware(['auth', 'verified'])->controller(InvoiceController::class)->group(function () {
    Route::get('{id}', 'show')->name('invoice.show');
    Route::get('{id}/download', 'download')->name('invoice.download');
    Route::delete('{id}', 'destroy')->name('invoice.destroy');
});


//Group all settings routes
Route::prefix('settings')->middleware(['auth', 'verified'])->controller(SettingsController::class)->group(function () {

    Route::get('/', 'index')->name('settings');

    Route::prefix('users')->group(function () {
        Route::get('/', 'usersIndex')->name('settings.users');
        Route::get('/search', 'usersSearch')->name('settings.users.search');
        Route::get('/create', 'usersCreate')->name('settings.users.create');
        Route::post('/create', 'usersStore')->name('settings.users.store');
        Route::get('/{id}/edit', 'usersEdit')->name('settings.users.edit');
        Route::patch('/{id}', 'usersUpdate')->name('settings.users.update');
        Route::delete('/{id}', 'usersDestroy')->name('settings.users.destroy');
        Route::patch('/{id}/password', 'usersResetPassword')->name('settings.users.resetPassword');
    });

});

Route::get('/email-sender', function () {
    return view('email-sender');
})->middleware(['auth', 'verified'])->name('email-sender');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
