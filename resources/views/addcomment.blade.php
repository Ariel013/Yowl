@extends('base')

@section('content')
    <div class="container">
        <h1>Ajouter un commentaire</h1>
        <form action="{{ route('commentaires.storeComment', $commentaire->id) }}" method="post">
            @csrf
            <label for="basic-url" class="form-label">URL</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon3">eg:https://example.com</span>
                <input type="text" class="form-control" id="url" name="url" value="{{ $commentaire->url }}"
                    pattern="https?://.+" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <div class="form-group">
                <input type="hidden" id="id_user" name="id_user" value="{{ session('utilisateur')->id }}">
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
