<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderExportController;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files', [FileController::class, 'index']);
Route::get('/download/{filename}', [FileController::class, 'download'])->name('download');
Route::get('/export-orders', [OrderExportController::class, 'exportOrdersToXml']);
