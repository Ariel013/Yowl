@extends('base')
@section('content')
    <div>
        <style>
            input[type="text"] {
                background-color: #fff;
                width: 30% !important;
                display: block;
                margin-left: auto;
                margin-right: auto;
                font-weight: bold;
                border: #fff;
            }
        </style>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Yowl</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <form class="d-flex">
                    <a href="login"
                    class="btn btn-primary btn-rounded"> <i class="fa-solid fa-user"></i>Login</a>
                                <a href="register"
                    class="btn btn-success btn-rounded"> <i class="fa-sharp fa-solid fa-users"></i> SignUp</a>
                    </form>
                </div>
            </div>
        </nav>
        <!--Fin de navbar-->
        <!--Debut de searchbar-->
        <section class="">
            <div class="cdb-form"
                style="background-image:url('https://www.pixfan.com/wp-content/uploads/2020/06/plus_belles_citations.jpg')">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text text-black" id="form-center"><i
                            class="fa-brands fa-searchengin"></i></span>
                    <input type="text" placeholder="Entrer votre recherche" style="background-color: white">
                </div>
            </div>

        </section>

        <!--Fin de la barre de recherche-->
        <section>
        <h2>Les commentaires</h2>
    <div class="container">
        @foreach ($com_lien->take(2) as $url => $commentaires)
            <div class="content py-4 mt-4" style="border: 2px solid black">
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><img src="{{ $url_info[$url]['iconUrl'] }}" class="rounded-circle shadow mr-5"
                                alt="Logo du site commenté" style="width: 80px;">
                            <span class="mr-3"><strong>{{ htmlspecialchars($url_info[$url]['title']) }} </strong></span>
                            <span><a href="{{ $url }}"><strong>{{ $url }}</strong></span></a>
                        </p>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <br>
                @foreach ($commentaires->take(6) as $commentaire)
                    <div class="row m-3 py-2" style="border:1px solid black; ">
                        <div class="col-md-3 mt-2">
                            <span
                                class="avatar bg-primary text-white px-3 py-3 m-2">{{ substr($commentaire->user->username, 0, 2) }}</span>
                            <span class="text-center"> <strong>{{ $commentaire->user->username }}</strong></span>

                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ $commentaire->commentaire }}</strong></p>
                        </div>
                      


                    </div>
                @endforeach
                <div class="container">
                    <a href="{{ route('show.showByUrl', base64_encode($url)) }}" class="btn btn-primary">Voir les
                        commentaires de ce lien</a>
                </div>

            </div>
            <br>
        @endforeach
        <br>
        @if ($com_lien->count() >= 3)
            <br>
            <a href="comment" class="btn btn-primary">Voir plus</a>
        @endif
    </div>
        </section>
        <br>

        <br>
    </div>
@endsection
