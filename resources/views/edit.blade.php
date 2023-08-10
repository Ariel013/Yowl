@extends('base')
@section('title')
    Modifier le produit
@endsection

@section('content')
    @if (session('utilisateur'))
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
                            <a href="commentaires>
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
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <a href="/logout" type="submit" class="btn btn-danger m-4">Déconnexion</a>
                    </form>
                </div>
            </div>
        </nav>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Metrre à jour votre profil</div>
                        <div class="card-body">
                            <form method="POST" action="/update/traitement">
                                @csrf
                                @method('PUT')
                                <input type="text" name="id" style="display: none"
                                    value="{{ session('utilisateur')->id }}">
                                <div class="form-group">
                                    <label for="titre">username</label>
                                    <input id="titre" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ $users->username }}" required autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">Prix</label>
                                    <input id="Price" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $users->email }}" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>





                                <!-- Ajoute les autres champs du formulaire pour les autres propriétés du produit -->

                                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <p>Vous devez vous reconnecter pour avoir accès à vos informations.</p>
    <p>Redirection vers la page de login...</p>
    <script>
        setTimeout(function() {
            window.location.href = "/login";
        }, 2000); // Redirection après 3 secondes
    </script>
@endif
