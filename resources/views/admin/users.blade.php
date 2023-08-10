@extends('admin.init')
@section('title', 'users')
@section('content')


    <div class="row" id="user">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="text-center border border-secondary mt-1 bg-secondary rounded-pill">@yield('title')</h1>
        </div>
        <div class="col-md-4">

        </div>

    </div>

    <div class="d-flex justify-content-end align-items-center">
        <div class="align-items-center d-flex mb-2">
            <div class="input-group justify-content-end">
                <span class="input-group-text" style="background-color: white; border: 1px solid white"
                    id="inputGroupPrepend2"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input style="border: none" type="text" id="validationDefaultUsername"
                    aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
    </div>
    <table class="table table-secondary table-striped">
        <thead>
            <tr>
                <th>N</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
                <th scope="col">Rule</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }} </td>
                    <td>{{ $user->username }} </td>
                    <td>{{ $user->email }} </td>
                    <td>{{ $user->sexe }} </td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="edit/{{ $user->id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="/suppr/{{ $user->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></button>
                            </form>

                        </div>
                    </td>
                    <td>
                        @if ($user->isadmin === 0)
                            <form action="/make/{{ $user->id }}" method="POST">
                                @csrf
                                @method('put')
                                <button class="btn btn-warning">user</button>
                            </form>
                        @else
                        <form action="/make/{{ $user->id }}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-warning">admin</button>
                        </form>

                        @endif

                    </td>



                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $users->links() }}
    </div>

@endsection
