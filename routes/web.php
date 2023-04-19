<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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


Route::get('/customers/create', [CustomersController::class, 'create'])->middleware(['auth', 'verified'])->name('customers.create');
Route::post('/customers/create', [CustomersController::class, 'store'])->middleware(['auth', 'verified'])->name('customer.store');
Route::get('/customers', [CustomersController::class, 'index'])->middleware(['auth', 'verified'])->name('customers');
Route::get('/customers/search', [CustomersController::class, 'search'])->middleware(['auth', 'verified'])->name('customers.search');
Route::get('/customers/{id}', [CustomersController::class, 'show'])->middleware(['auth', 'verified'])->name('customers.show');
Route::get('/customers/{id}/edit', [CustomersController::class, 'edit'])->middleware(['auth', 'verified'])->name('customers.edit');
Route::patch('/customers/{id}', [CustomersController::class, 'update'])->middleware(['auth', 'verified'])->name('customer.update');
Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->middleware(['auth', 'verified'])->name('customer.destroy');
Route::post('/customers/{id}/add-invoice', [InvoiceController::class, 'store'])->middleware(['auth', 'verified'])->name('invoice.store');


Route::get('/customers/{id}/add-invoice', [InvoiceController::class, 'upload'])->middleware(['auth', 'verified'])->name('customers.add-invoice');

Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->middleware(['auth', 'verified'])->name('invoice.show');
Route::get('/invoice/{id}/download', [InvoiceController::class, 'download'])->middleware(['auth', 'verified'])->name('invoice.download');
Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy'])->middleware(['auth', 'verified'])->name('invoice.destroy');


Route::get('/email-sender', function () {
    return view('email-sender');
})->middleware(['auth', 'verified'])->name('email-sender');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
