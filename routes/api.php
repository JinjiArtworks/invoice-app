<?php

use App\Http\Controllers\Api\CustomerApi;
use App\Http\Controllers\Api\InvoiceApi;
use App\Http\Controllers\Api\ProductApi;
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
Route::apiResource('/invoice', InvoiceApi::class);
Route::get('/searchInvoice', [InvoiceApi::class, 'searchInvoice']);
Route::get('/createInvoice', [InvoiceApi::class, 'createInvoice']);
Route::get('/editInvoice/{id}', [InvoiceApi::class, 'editInvoice']);
Route::get('/showInvoice/{id}', [InvoiceApi::class, 'showInvoice']);
Route::post('/updateInvoice/{id}', [InvoiceApi::class, 'updateInvoice']);
Route::get('/deleteInvoiceItem/{id}', [InvoiceApi::class, 'deleteInvoiceItem']);
Route::get('/deleteInvoice/{id}', [InvoiceApi::class, 'deleteInvoice']);

Route::apiResource('/customers', CustomerApi::class);

Route::apiResource('/products', ProductApi::class);
