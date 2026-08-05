<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\CommentairesControl;
use App\Http\Controllers\dashbordController;
use App\Http\Controllers\ControlUser;
use App\Http\Controllers\CommentairesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [CommentairesController::class, 'first']);
Route::get('/login', [ControlUser::class, 'from_login']);
Route::post('/login/traitement', [ControlUser::class, 'traitement_login']);
Route::get('/register', [ControlUser::class, 'from_register']);
Route::post('/register/traitement', [ControlUser::class, 'traitement_register']);
Route::get('/confirmation/{token}', [ControlUser::class, 'confirmationMail'])->name('confirmation');
Route::get('/search', [SearchController::class, 'search']);
Route::get('/index', [SearchController::class, 'search']);
Route::get('/show/{encodedUrl}', [CommentairesController::class, 'showAll'])->name('show.showByUrl');
Route::get('/comment', [CommentairesController::class, 'allcomment'])->name('comment');
Route::get('/commentplus', [CommentairesController::class, 'commentplus'])->name('commentplus');
Route::get('/commentaires', [CommentairesController::class, 'index'])->name('commentaires');
Route::get('/solocomment/utilisateur/{userId}', [CommentairesController::class, 'showUserComments'])->name('solocomment.utilisateur');

// Authenticated user routes
Route::middleware(['is_authenticated'])->group(function () {
    Route::get('/logout', [ControlUser::class, 'logout']);
    Route::get('/userProfil', fn () => view('userProfil'));
    Route::get('/edit/{id}', [ControlUser::class, 'edit']);
    Route::put('/update/traitement', [ControlUser::class, 'update']);

    Route::post('/commentaires', [CommentairesController::class, 'store'])->name('commentaires.store');
    Route::delete('/commentaires/{id}', [CommentairesController::class, 'destroy'])->name('commentaires.destroy');
    Route::get('/commentaires/{id}/edit', [CommentairesController::class, 'edit'])->name('commentaires.edit');
    Route::get('/commentaires/{id}/editSolo', [CommentairesController::class, 'editSolo'])->name('commentaires.editSolo');
    Route::put('/commentaires/{id}', [CommentairesController::class, 'update'])->name('commentaires.update');
    Route::post('/commentaires/{id}/like', [CommentairesController::class, 'likeCommentaire'])->name('commentaires.like');
    Route::get('/commentaires/{id}/addcomment', [CommentairesController::class, 'addComment'])->name('commentaires.addcomment');
    Route::post('/commentaires/{id}/commentaire', [CommentairesController::class, 'storeComment'])->name('commentaires.storeComment');
});

// Admin routes
Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin', [dashbordController::class, 'index']);
    Route::get('/users', [UserControl::class, 'index']);
    Route::delete('/suppr/{id}', [UserControl::class, 'destroy']);
    Route::get('/admin/users/{id}/edit', [UserControl::class, 'edit']);
    Route::put('/admin/users/{id}', [UserControl::class, 'update']);
    Route::put('/make/{id}', [UserControl::class, 'make']);
    Route::get('/adminComment', [CommentairesControl::class, 'index']);
    Route::delete('/commentDel/{id}', [CommentairesControl::class, 'destroy']);
});
