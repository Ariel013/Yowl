@extends('admin.init')




@section('content')
@if (session('utilisateur'))
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-2 bg-info-subtle" id="sidebar">
                <div class="" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-house"></i>
                                Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users"><i class="fa-solid fa-user"></i> Users</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/adminComment"><i class="fa-solid fa-comment"></i> Comments</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10" style="margin-left: 17%">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4 h-100">
                        <div class="card border-left-primary shadow h-100 bg-success py-2" style="--bs-bg-opacity: .5;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            USERS</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="users">{{ $Nusers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary bg-warning shadow h-100 py-2" style="--bs-bg-opacity: .5;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            COMMENTS</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="comments">{{ $Ncommentaires }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-comment"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow bg-danger h-100 py-2" style="--bs-bg-opacity: .5;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            Most Comments</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $url }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-comments"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary bg-primary shadow h-100 py-2" style="heigth: 100px;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                            Most liked Comment</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $likes[0]->commentaire }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-group"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xl-1 col-md-6">
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <svg></svg>
                    </div>
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-primary bg-secondary shadow h-100 py-2" style="--bs-bg-opacity: .5;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-white text-center text-uppercase mb-1">
                                            Genders</div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <div>
                                                <h5>Male</h5>
                                                <p class="text-center">{{ $Nmale }} </p>

                                            </div>
                                            <div>
                                                <h5>Female</h5>
                                                <p class="text-center">{{ $Nfem }} </p>

                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        </div>
       <script>
        var users= @json($Nusers);
        var commentaires= @json($Ncommentaires);
       </script>
     @else
    <p>Vous devez vous reconnecter pour avoir accès à vos informations.</p>
    <p>Redirection vers la page de login...</p>
    <script>
        setTimeout(function() {
            window.location.href = "/login";
        }, 2000); // Redirection après 3 secondes
    </script>
@endif
   
   @endsection
