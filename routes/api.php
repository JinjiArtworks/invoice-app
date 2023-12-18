<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/getInvoices', [InvoiceController::class, 'getInvoices']);
Route::apiResource('/invoice', InvoiceController::class);
Route::get('/searchInvoice', [InvoiceController::class, 'searchInvoice']);
Route::get('/createInvoice', [InvoiceController::class, 'createInvoice']);
Route::get('/editInvoice/{id}', [InvoiceController::class, 'editInvoice']);
Route::get('/showInvoice/{id}', [InvoiceController::class, 'showInvoice']);
Route::post('/updateInvoice/{id}', [InvoiceController::class, 'updateInvoice']);
Route::get('/deleteInvoiceItem/{id}', [InvoiceController::class, 'deleteInvoiceItem']);
Route::get('/deleteInvoice/{id}', [InvoiceController::class, 'deleteInvoice']);

Route::apiResource('/customers', CustomerController::class);

Route::apiResource('/products', ProductController::class);
