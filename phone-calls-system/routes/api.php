<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CallController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\CityController;

Route::apiResource('calls', CallController::class);
Route::apiResource('subscribers', SubscriberController::class);
Route::apiResource('cities', CityController::class);