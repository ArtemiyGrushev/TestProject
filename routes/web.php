<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderExportController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/export-orders', [OrderExportController::class, 'exportOrdersToXml']);
