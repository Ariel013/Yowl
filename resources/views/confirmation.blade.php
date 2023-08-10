
@extends('base')

@section('content')
    <h1>Confirmation d'inscription</h1>

    <p>Pour confirmer que c'est bien vous qui est entrain de créer le compte veuillez cliqué ce lien pour confirmer votre compte :</p>

    <a href="{{ url('confirmation', $mailData['token']) }}">{{ url('confirmation', $mailData['token']) }}</a>
@endsection
