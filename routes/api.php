<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\OriginController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\FoodMenuController;

Route::apiResource('category', CategoryController::class);
Route::apiResource('sub-category', SubCategoryController::class);
Route::apiResource('origin', OriginController::class);
Route::apiResource('unit', UnitController::class);
Route::apiResource('food-menu', FoodMenuController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
