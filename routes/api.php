<?php

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

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_all_invoice', [InvoiceController::class, 'index']);
Route::get('/search_invoice', [InvoiceController::class, 'search_Invoice']);
Route::get('/createInvoice', [InvoiceController::class, 'createInvoice']);
Route::get('/customers', [CustomerController::class, 'getAllCustomers']);
Route::get('/products', [ProductController::class, 'allProducts']);
Route::post('/add_invoice', [InvoiceController::class, 'add_invoice']);

