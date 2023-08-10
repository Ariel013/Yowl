<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/stylz.css') }}">
    <title>Yowl</title>
</head>

<body style=" background-color: rgb(202, 202, 194)">

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light my-3">
            <div class="container-fluid">
                <router-link to="/admin">
                    <p class="navbar-brand"><a href="/admin"><i><strong style="font-size: 300%">YOWL</strong></i> </a></p>
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                        <div class="dropdown m-3 mt-4">
                            <p class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{session('utilisateur')->username}}
                            </p>
                            <ul class="dropdown-menu">
                                <li>
                                    <p class="dropdown-item">
                                        <a href="commentaires">
                                            Ajouter commentaires</a>
                                    </p>
                                </li>

                                <li><a href="adminProfil">
                                        <p class="dropdown-item">Profile</p>
                                    </a></li>

                            </ul>
                        </div>
                        <a href="/logout" type="submit" class="btn btn-danger m-4">Déconnexion</a>
                    </form>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>






    <script src='https://cdnjs.cloudflare.com/ajax/libs/d3/5.7.0/d3.min.js'></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>
</body>

</html>
