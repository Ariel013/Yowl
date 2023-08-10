@extends('base')

<body style="background-color: rgb(202, 202, 194)">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link to="acceuil">
                    <p class="navbar-brand"><strong style="font-size: 300%">YOWL</strong></p>
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                                            <p class="dropdown-item">Dashboard</p>
                                        </a>
                                    </li>
                                @endif
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
        <!--Fin de navbar-->

        <br>
        <div class="container">
            <h4>Profil</h4>
            <br>
            @if (@session('status'))
                <div class="alert alert-primary" role="alert">
                    <p class="status-message">{{ @session('status') }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-fluid">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <h5 class="text-center m-3">Informations personnelles</h5>
                                <div class="col-auto">
                                    <!-- Avatar -->
                                    <p class="avatar rounded-circle">
                                        <span
                                            class="avatar bg-primary text-white py-3 px-3">{{ strtoupper(substr(session('utilisateur')->username, 0, 2)) }}</span>

                                    </p>
                                </div>
                                <div class="col ml-md-n2">
                                    <p class="d-block  mb-0 text-muted"> <strong>Username:
                                        </strong>{{ session('utilisateur')->username }}</p>
                                    <br>
                                    <small class="d-block text-muted"><strong> Compte:</strong>
                                        @if (session('utilisateur')->isadmin = 1)
                                            Utilisateur
                                    </small>
                                @elseif (session('utilisateur')->isadmin)
                                    Utilisateurs</small>
                                    @endif

                                    <br>
                                    <small class="d-block text-muted"><strong>Email:</strong>
                                        {{ session('utilisateur')->email }}</small>
                                    <br>
                                    <small class="d-block text-muted"> <strong>Sexe:</strong>
                                        {{ session('utilisateur')->sexe }}</small>
                                    <br>
                                    <small class="d-block text-muted"> <strong>Age:</strong>
                                        {{ session('utilisateur')->age }}</small>
                                </div>
                                <div class="col-auto">

                                    <button type="button" class="btn btn-xs btn-primary btn-icon rounded-pill">
                                        <span class="btn-inner--icon"><font-awesome-icon
                                                icon="fa-solid fa-edit" /></span>
                                        <span class="btn-inner--text"> <a href="/edit/{{ session('utilisateur')->id }}"
                                                class="text-white">Modifier</a></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <section>
        <div class="container">
            <div class="row align-items-center mt-4">
                <div class="col">
                    <h4 class="h5 mb-0">
                        Mes commentaires
                    </h4>
                </div>
                <a href="{{ route('solocomment.utilisateur', ['userId' => session('utilisateur')->id]) }}">Voir mes
                    commentaire</a>

                <div class="col-auto">
                    <div class="dropdown">
                        <a href="commentaires"> <button type="button"
                                class="btn btn-sm btn-primary btn-icon-only rounded-circle">
                                <span class="btn-inner--icon"><i class="fas fa-plus  text-white "></i></span>
                            </button></a>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <br>
        </div>
        </div>
        </div>

        </div>
        </div>
    </section>
