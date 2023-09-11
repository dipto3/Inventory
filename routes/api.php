<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VendorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('email-verification',[EmailVerificationController::class, 'email_verification']);
    Route::get('email-verification',[EmailVerificationController::class, 'sendEmailVerification']);

    Route::post('/create-category', [CategoryController::class, 'store']);
    Route::get('/all-category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::post('/update-category/{id}', [CategoryController::class, 'update']);
    Route::post('/category/{id}', [CategoryController::class, 'destroy']);

    Route::post('/create-subcategory', [SubcategoryController::class, 'create']);
    Route::get('/all-subcategory', [SubcategoryController::class, 'index']);
    Route::get('/subcategory/{id}', [SubcategoryController::class, 'show']);
    Route::post('/update-subcategory/{id}', [SubcategoryController::class, 'update']);
    Route::post('/subcategory/{id}', [SubcategoryController::class, 'destroy']);

    Route::post('/create-vendor', [VendorController::class, 'store']);
    Route::get('/all-vendor', [VendorController::class, 'index']);
    Route::get('/vendor/{id}', [VendorController::class, 'show']);
    Route::post('/update-vendor', [VendorController::class, 'update']);
    Route::post('/vendor/{id}', [VendorController::class, 'destroy']);

    Route::post('/create-item',[ItemController::class,'create']);

});
