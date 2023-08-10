@extends('admin.init')
@section('content')
    <div class="container mt-3">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="text-center border border-1 bg-secondary rounded-pill fst-italic">Modify this profile</h1>
        </div>
        <div class="col-md-4"></div>

    </div>
   <form action="/update/{{$user->id}}" method="POST">
    @csrf
    @method("PUT")
    <div class="d-flex-row">
        <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Username:</label>
            <div class="col">
                <input type="link" class="form-control" id="exampleFormControlInput1" name="username" value="{{ $user->username }}" placeholder="">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="exampleFormControlInput1" class="col-sm-2 col-form-label">Email:</label>
            <div class="col">
                <input type="link" name="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->email }}" placeholder="">
            </div>
        </div>

        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <button type="button" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-info">Save change</button>
            </div>
        </div>
    </div>
   </form>
</div>

@endsection
