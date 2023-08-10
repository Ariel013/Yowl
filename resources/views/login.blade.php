<!---------------------------------------------------------------------------------------------------------------->
@extends('base')

@section('title')
    Login
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
    <br><br><br>
    @section('content')
        <div class="container">
            <div class="content">
                <div class="row py-3 w-60">
                    <div class="col-md-3">
                        <h2 class="text-center mt-5">Connexion</h2>
                        <br>
                        @if (session('status'))
                            <div class="alert alert-danger" role="alert">
                                <p>{{ session('status') }}!</p>
                            </div>
                        @endif
                        <form action="/login/traitement" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="userMail"
                                            value="{{ old('username') }}" placeholder="Username or adresse Email"
                                            name="userCredential" style="width: 300px; height:50px; border-radius:2%">
                                    </div>
                                    {{-- @error('userMail')
                                     <p class="error-message">{{ $message }}</p>
                                 @enderror --}}
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="userPassword" placeholder="Password"
                                            name="password" style="width: 300px; height:50px; border-radius:2%">
                                    </div>
                                    {{-- @error('userPassword')
                                     <p class="error-message">{{ $message }}</p>
                                 @enderror --}}
                                </div>
                            </div>
                            <br>
                            <br>
                            <center>
                                <div class="form-group">
                                    <button class="btn btn-secondary">Connexion</button>
                                </div>
                                <br>
                                <div style="background-color: white; opacity: 0.8" class="py-3"><p class="text-sm"> Vous n'avez pas un compte sur ads? <br> <a href="register"
                                        class="text-black">Inscrivez-vous</a>
                                </p>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">

                </div>

            </div>
        </div>
    @endsection
