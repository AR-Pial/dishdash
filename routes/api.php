<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\OriginController;


Route::apiResource('category', CategoryController::class);
Route::apiResource('sub-category', SubCategoryController::class);
Route::apiResource('origin', OriginController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
