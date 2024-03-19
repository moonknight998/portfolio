<?php

use App\Http\Controllers\Admin\Section\AboutController;
use App\Http\Controllers\Admin\Section\Blog\BlogCategoryController;
use App\Http\Controllers\Admin\Section\Blog\BlogPostController;
use App\Http\Controllers\Admin\Section\HeroController;
use App\Http\Controllers\API\AuthTokenController;
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

Route::post('request_token', [AuthTokenController::class, 'requestToken']);

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'v1', 'as' => 'v1.'], function () {

    Route::get('/user', function (Request $request) {
        $arr = [
            'status' => 'success',
            'message' => 'Get hero section data successfully!',
            'data' => $request->user(),
        ];
        return response()->json($arr, 200);
    });

    Route::resource('about', AboutController::class);
    Route::resource('hero', HeroController::class);

    Route::resource('blog_category', BlogCategoryController::class);
    Route::resource('blog_post', BlogPostController::class);

});
