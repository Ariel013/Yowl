@extends('base')
<?php

use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\API\SearchController;
use Illuminate\Support\Facades\Route;
use App\Models\Commentaire;
use App\Models\Comment;
use Illuminate\Http\Request;
?>

<!doctype html>
<body style="background-color: rgb(202, 202, 194)">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <router-link to="acceuil">
                <p class="navbar-brand"><strong style="font-size: 300%">YOWL</strong></p>
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
                        <strong style="font-size: 150%">Home</strong>
                        </a>
                    </p>
                    <div class="dropdown m-3">
                        <p class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('utilisateur')->username }}
                        </p>
                        <ul class="dropdown-menu">
                        @if(session('utilisateur')->isadmin === 1)
                            <li><a href="admin">
                                    <p class="dropdown-item">Dasboard</p>
                                </a>
                            </li>
                            @endif
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
            <form action="search" role="search" method="get">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text text-black" id="form-center"><i
                            class="fa-brands fa-searchengin"></i></span>
                    <input type="text" placeholder="Entrer votre recherche"
                        style="background-color: white; width: 500px; border:none" name="query" required>
                </div>
            </form>
        </div>

    </section>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<div>
    @if (empty($commentaires))
		<p> Sorry no products found.</p>
		

	@else
	<div class="container">
        @foreach ($commentaires as $commentaire)
            <div class="content py-4 mt-4" style="border: 2px solid black">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p>
                            <span>{{ $commentaire->url}}, {{ $commentaire->commentaire }}</span>
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

                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
	@endif
</div>
</html>