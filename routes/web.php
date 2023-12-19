<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('index');
    Route::get('/invoice/new', [InvoiceController::class, 'create'])->name('create');
    Route::get('/invoice/show/{id}', [InvoiceController::class, 'show'])->name('show');
    Route::get('/invoice/edit/{id}', [InvoiceController::class, 'edit'])->name('edit');
});
// Route::get('/{pathMatch}', function () {
//     return view('error404');
// })->where('pathMatch', '.*');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
