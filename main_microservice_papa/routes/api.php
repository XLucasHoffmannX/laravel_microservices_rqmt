<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('products', [ProductController::class, 'index']);
Route::post('products/{id}/like/{userid}', [ProductController::class, 'like']);
