<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::apiResource('commentaires', CommentaireController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('likes', LikeController::class);

Route::post('/commentaires/{commentaire}/like', [CommentaireController::class, 'like']);
Route::get('/commentaires/search', [CommentaireController::class, 'search']);
Route::get('/users/search', [UserController::class, 'searchByUsername']);
