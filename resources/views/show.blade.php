@extends('base')

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
    <div class="container">
        <h4>Tous les commentaires pour {{ $url_info['title'] }}</h4>
        <!-- Affichez les informations de l'URL ici -->

        @foreach ($commentaires as $commentaire)
            <div class="row m-3 py-2" style="border:1px solid black;">
                <div class="col-md-3 mt-2">
                    <span
                        class="avatar bg-primary text-white px-3 py-3 m-2">{{ substr($commentaire->user->username, 0, 2) }}</span>
                    <span class="text-center"> {{ $commentaire->user->username }}</span>
                </div>
                <div class="col-md-6">
                    <p>{{ $commentaire->commentaire }}</p>
                    @if (session('utilisateur') && session('utilisateur')->id === $commentaire->id_user)
                        <a href="{{ route('commentaires.editSolo', $commentaire->id) }}"
                            class="badge badge-pill bg-secondary m-2" style="width: 50px"><i
                                class="fas fa-edit text-white "></i></a>
                        <form action="{{ url('/commentaires/' . $commentaire->id) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="badge badge-pill bg-danger m-2" style="width: 50px"><i
                                    class="fas fa-trash text-white "></i></button>
                        </form>
                    @endif
                    <form action="{{ route('commentaires.like', $commentaire->id) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        <button type="submit" class="badge badge-pill bg-secondary m-2" style="width: 50px">
                            <i
                                class="fa {{ $commentaire->likes->contains('id_user', session('utilisateur')->id) ? 'fa-thumbs-down' : 'fa-thumbs-up' }}"></i>
                            {{ $commentaire->likes->count() }}
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
