<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('form');
});

Route::any('/submit', [PaymentController::class, 'create'])->name('payment.checkout');
Route::get('toyyibpay-status', [PaymentController::class, 'paymentstatus'])->name( 'toyyibpay-status');
Route::post('toyyibpay-callback', [PaymentController::class, 'callback'])->name( 'toyyibpay-callback');
