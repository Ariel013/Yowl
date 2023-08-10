<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\API\SearchController;

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

Route::apiResource("users", UserController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("commentaires", CommentaireController::class);

Route::middleware('auth:sanctum')->get('/commentaire', function (Request $request) {
    return $request->commentaire();
});

Route::apiResource("comments", CommentController::class);

Route::middleware('auth:sanctum')->get('/comment', function (Request $request) {
    return $request->comment();
});

Route::apiResource("likes", CommentController::class);

Route::middleware('auth:sanctum')->get('/like', function (Request $request) {
    return $request->like();
});

Route::middleware('auth:api')->group(function () {
    // Vos autres routes protégées ici
})->middleware('verified');

Route::post('/commentaires/{commentaire}/like', [CommentaireController::class, 'like']);


Route::get('/commentaires', 'API\CommentaireController@index');

Route::get('/commentaires/search', 'API\CommentaireController@search');

Route::get('users/username={username}', 'API\UserController@searchByUsername');

Route::get('commentaires/commentaire={commentaire}', 'API\CommentaireController@search');