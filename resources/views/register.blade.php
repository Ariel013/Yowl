@extends('base')

@section('title')
    Register
@endsection

<body style="background-image:url('https://www.pixfan.com/wp-content/uploads/2020/06/plus_belles_citations.jpg'); background-size : cover">

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
    <div>
        @section('content')
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="/register/traitement" method="post">
                                @csrf
                                @if (@session('status'))
                                    <br>
                                    <div class="alert alert-primary" role="alert">
                                        <p class="status-message"><strong>{{ @session('status') }}</strong></p>
                                    </div>
                                @else
                                    <h3 class="text-center mt-5">INSCRIPTION</h3>
                                @endif

                                <div class="form-group m-3">
                                    <input type="text" class="form-control" id="username" value="{{ old('username') }}"
                                        placeholder="Username" name="username"
                                        style="width: 300px; height:50px; border-radius:2%">
                                </div>
                                @error('username')
                                    <p class="error-message text-small">{{ $message }}</p>
                                @enderror


                                <div class="form-group m-3">
                                    <input type="email" class="form-control" id="userMail" value="{{ old('userMail') }}"
                                        placeholder="Adresse Email" name="email"
                                        style="width: 300px; height:50px; border-radius:2%">
                                </div>
                                @error('email')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror




                                <div class="form-group m-3">
                                    <select class="form-select form-select" aria-label="Large select example" name="sexe"
                                        style="width: 300px; height:50px; border-radius:2%">
                                        <option selected disabled><small class="text-grey">Votre sexe</small>
                                        </option>
                                        <option value="M">Masculin</option>
                                        <option value="F">Féminin</option>
                                    </select>
                                </div>
                                @error('sexe')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror

                                <div class="col-md-6">
                                    <div class="form-group m-3">
                                        <input type="number" class="form-control" id="Age"
                                            placeholder="Age(Entre 13 et 35)" name="age"
                                            style="width: 300px; height:50px; border-radius:2%">
                                    </div>
                                    @error('age')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror



                                    <div class="form-group m-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password"
                                            name="password" style="width: 300px; height:50px; border-radius:2%">
                                    </div>
                                    @error('password')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror



                                    <div class="form-group m-3">
                                        <input type="password" class="form-control" id="passwordconf"
                                            placeholder="Confirmer le password" name="passwordconf"
                                            style="width: 300px; height:50px; border-radius:2%">
                                    </div>
                                    @error('passwordconf')
                                        <p class="error-message">{{ $message }}</p>
                                    @enderror
                                </div>
                                <center>
                                    <br>
                                    <div class="form-group ">
                                        <button class="btn btn-primary">S'inscrire</button>
                                    </div>
                                    <br>
                                    <div style="background-color: white; opacity: 0.6" class="py-3"><p class="text-sm">Vous avez déjà un compte sur ads? <br> <a
                                            href="login">Connectez-vous</a></p>
                                    </div>
                                </center>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endsection
