@extends('base')

<body style="background-color: rgb(202, 202, 194)">

    @section('content')
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
                                        <a href="commentaires">
                                            Ajouter commentaires</a>
                                    </p>
                                </li>

                                <li><a href="userProfil">
                                        <p class="dropdown-item">Profile</p>
                                    </a></li>

                            </ul>
                        </div>
                        <a href="/logout" type="submit" class="btn btn-danger m-4">Déconnexion</a>
                    </form>
                </div>
            </div>
        </nav>
        <br><br>
        <div class="container">
            <div>
                <h1>Modifier le commentaire</h1>
                <form action="/commentaires" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" style="display: none" value="{{ $commentaire->id }}">
                    <label for="">Le commentaire de cet url {{ $commentaire->url }}</label>
                    <br>
                    <textarea class="form-control" name="commentaire">{{ $commentaire->commentaire }}</textarea>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    @endsection
