@extends('base')

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
                            <strong style="font-size: 300%">Home</strong>
                        </a>
                    </p>
                    <div class="dropdown m-3">
                        <p class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ session('utilisateur')->username }}
                        </p>
                        <ul class="dropdown-menu">
                            <li>
                                <p class="dropdown-item">
                                    <a href="/commentaires">
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
    <div class="container">
        <ul class="list-unstyled">
            <br>
            <li>
                @foreach ($com_lien as $url => $commentaires)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $url }}</h5>
                            <p class="card-text"><strong>Titre:</strong>
                                {{ htmlspecialchars($url_info[$url]['title']) }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $url_info[$url]['description'] }}</p>
                            @if ($url_info[$url]['iconUrl'])
                                <img src="{{ $url_info[$url]['iconUrl'] }}" alt="Icône du site">
                            @endif
                            <p class="card-text"></p>
                            <p class="card-text"><small class="text-muted"></small></p>
                            @foreach ($commentaires as $commentaire)
                                <p class="card-text">{{ $commentaire->commentaire }}</p>
                                <form action="{{ url('/commentaires/' . $commentaire->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a
                                        href="{{ route('commentaires.editSolo', $commentaire->id) }}"class="btn btn-primary">Modifier</a>

                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </li>

        </ul>
    </div>
