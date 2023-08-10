<?php

use App\Http\Controllers\CommentairesController;
// use App\Http\Controllers\API\CommentairesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\API\SearchController;
use Illuminate\Support\Facades\Route;
use App\Models\Commentaire;
use App\Models\Comment;
use Illuminate\Http\Request;
?>

@extends('base')

<body style="background-color: rgb(202, 202, 194)">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link to="acceuil">
                <p class="navbar-brand">Yowl</p>
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex">
                    <p class="m-4">
                        <a href="commentaires">
                            Home
                        </a>
                    </p>
                    <div class="dropdown m-3">
                        <p class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('utilisateur')->username }}
                        </p>
                        <ul class="dropdown-menu">
                            <li>
                                <p class="dropdown-item">
                                    <a href="addcomments">
                                        Ajouter commentaires</a>
                                </p>
                            </li>

                            <li><a href="userProfil">
                                    <p class="dropdown-item">Profile</p>
                                </a></li>
                            <li><a href="allcomments">
                                    <p class="dropdown-item">Les commentaires</p>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <a href="/logout" type="submit" class="btn btn-danger m-4">Déconnexion</a>
                </form>
            </div>
        </div>
    </nav>
    <section class="">
        <div class="cdb-form"
            style="background-image:url('https://www.pixfan.com/wp-content/uploads/2020/06/plus_belles_citations.jpg')">
            <form action="search">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text text-black" id="form-center"><i
                            class="fa-brands fa-searchengin"></i></span>
                    <input type="text" placeholder="Entrer votre recherche"
                        style="background-color: white; width: 200px; border:none">
                </div>
            </form>
        </div>

    </section>

    <div class="container">
        @if (@session('status'))
            <div class="alert alert-primary" role="alert">
                <p class="status-message">{{ @session('status') }}</p>
            </div>
        @endif
        <br><br>
        <h6>Ajouter un commentaire</h6>
        <form action="commentaires" method="post">
            @csrf
            <label for="basic-url" class="form-label">URL</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">eg:https://example.com</span>
                <input type="text" class="form-control" id="url" name="url" pattern="https?://.+"
                    id="basic-url" aria-describedby="basic-addon3">
            </div>
            <div class="form-group">
                <input type="hidden" id="id_user" name="id_user" value="{{ session('utilisateur')->id }}">
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <br>
    <div class="container">
        <a href="commentaires" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i>
            Revenir en arrière</a>
    </div>
    <br>
    <div class="container">
        @foreach ($com_lien->slice(2) as $url => $commentaires)
            <div class="content py-4 mt-4" style="border: 2px solid black">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><img src="{{ $url_info[$url]['iconUrl'] }}" class="rounded-circle shadow mr-5"
                                alt="Logo du site commenté" style="width: 80px;">
                            <span class="mr-3">{{ htmlspecialchars($url_info[$url]['title']) }} </span>
                            <span><a href="{{ $url }}">{{ $url }}</span></a>
                        </p>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <br>
                @foreach ($commentaires->take(2) as $commentaire)
                    <div class="row m-3 py-2" style="border:1px solid black; ">
                        <div class="col-md-3 mt-2">
                            <span
                                class="avatar bg-primary text-white px-3 py-3 m-2">{{ substr($commentaire->user->username, 0, 2) }}</span>
                            <span class="text-center"> {{ $commentaire->user->username }}</span>

                        </div>
                        <div class="col-md-6">
                            <p>{{ $commentaire->commentaire }}</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('commentaires.like', $commentaire->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    <button type="submit" class="badge badge-pill bg-secondary m-2"
                                        style="width: 50px">
                                        <i
                                            class="fa {{ $commentaire->likes->contains('id_user', session('utilisateur')->id) ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                                        {{ $commentaire->likes->count() }}
                                    </button>
                                </form>
                                <a href="{{ route('commentaires.addcomment', $commentaire->id) }}"
                                    class="badge badge-pill bg-secondary m-2" style="width: 50px"><i
                                        class="fas fa-plus text-white "></i></a>
                            </div>
                            <div class="col-md-6">
                                <div style="float: right">
                                    @if (session('utilisateur') && session('utilisateur')->id === $commentaire->id_user)
                                        <a href="{{ route('commentaires.editSolo', $commentaire->id) }}"
                                            class="badge badge-pill bg-secondary m-2" style="width: 50px"><i
                                                class="fas fa-edit text-white "></i></a>
                                        <form action="{{ url('/commentaires/' . $commentaire->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-pill bg-danger m-2"
                                                style="width: 50px"><i class="fas fa-trash text-white "></i></button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                @endforeach
                <div class="container">
                    <a href="{{ route('show.showByUrl', base64_encode($url)) }}" class="btn btn-primary">Voir les
                        commentaires de ce lien</a>
                </div>

            </div>
        @endforeach
        <br>

        @if ($com_lien->count() >= 5)
            <br>
            <a href="comment" class="btn btn-primary">Voir plus</a>
        @endif
    </div>
    <br><br>
