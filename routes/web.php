<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PythonController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/data', [DashboardController::class, 'data']);
Route::get('/script', [PythonController::class, 'runScript']);
