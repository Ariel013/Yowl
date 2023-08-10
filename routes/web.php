<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\API\CommentaireController;
use App\Http\Controllers\CommentairesControl;
use App\Http\Controllers\dashbordController;
use App\Models\Commentaire;
use App\Models\User;use App\Http\Controllers\ControlUser;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CommentairesController::class, 'first']);

Route::get('/userProfil', function () {
    return view('userProfil');
});
Route::get('/login', [ControlUser::class, 'from_login']);
Route::post('/login/traitement', [ControlUser::class, 'traitement_login']);
Route::get('/register', [ControlUser::class, 'from_register']);
Route::post('/register/traitement', [ControlUser::class, 'traitement_register']);
Route::get('/confirmation/{token}', [ControlUser::class, 'confirmationMail'])->name('confirmation.');
Route::put('/update/traitement/', [ControlUser::class, 'update']);
Route::get('/edit/{id}', [ControlUser::class, 'edit']);
Route::get('/logout', [ControlUser::class, 'logout']);

Route::get('/commentaires', function () {
    return view('Commentaires');
})->name('commentaires');

Route::get('/confirmation/{token}', [ControlUser::class, 'confirmationMail'])->name('confirmation');
Route::get('/confirmation/{token}', [ControlUser::class, 'confirmationMail'])->name('confirmation');

Route::get('/search', [SearchController::class, 'search']);

Route::get('/commentaires', [CommentairesController::class, 'index'])->name('commentaires');

Route::post('/commentaires', [CommentairesController::class, 'store'])->name('commentaires');

Route::delete('/commentaires/{id}', [CommentairesController::class, 'destroy']);

//Route::put('/commentaires/{id}', [CommentairesController::class, 'update'])->name('commentaires.update');

Route::get('/commentaires/{id}/edit', [CommentairesController::class, 'edit'])->name('commentaires.edit');

Route::post('/commentaires/{id}/like', [CommentairesController::class, 'likeCommentaire'])->name('commentaires.like');
Route::get('/commentaires/{id}/update', [CommentairesController::class, 'edit'])->name('commentaires.update');
Route::put('commentaires/{id}', 'CommentairesController@update')->name('commentaires.update');
Route::get('/solocomment/utilisateur/{userId}', [CommentairesController::class, 'showUserComments'])->name('solocomment.utilisateur');

Route::get('/commentaires/{id}/edit', [CommentairesController::class, 'editSolo'])->name('commentaires.editSolo');
Route::put('/update/traitement/', [CommentairesController::class, 'update']);
Route::put('/commentaires/', [CommentairesController::class, 'update']);

Route::get('/index', [SearchController::class, 'search']);

Route::get('/users', [UserControl::class, "index"]
);
Route::delete('/suppr/{id}', [UserControl::class, "destroy"]);
Route::get('/edit/{id}', [UserControl::class, "edit"]);
Route::put('/update/{id}', [UserControl::class, "update"]);
Route::put('/make/{id}', [UserControl::class, "make"]);
Route::get('/adminComment', [CommentairesControl::class,'index']);
Route::delete('/commentDel/{id}', [CommentairesControl::class,'destroy']);
Route::get('/admin', [dashbordController::class, 'index']);
Route::get('/show/{encodedUrl}', [CommentairesController::class, 'showAll'])->name('show.showByUrl');
Route::get('/comment', [CommentairesController::class, 'allcomment'])->name('comment');
Route::get('/commentplus', [CommentairesController::class, 'commentplus'])->name('commentplus');
Route::get('/commentaires/{id}/addcomment', [CommentairesController::class, 'addComment'])->name('commentaires.addcomment');
Route::post('/commentaires/{id}/commentaire', [CommentairesController::class, 'storeComment'])->name('commentaires.storeComment');
