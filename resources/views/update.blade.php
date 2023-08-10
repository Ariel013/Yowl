<form action="{{ route('commentaires.update', ["id" => $commentaire->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="commentaire">Commentaire</label>
        <textarea class="form-control" id="commentaire" name="commentaire">{{ $commentaire->commentaire }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>
