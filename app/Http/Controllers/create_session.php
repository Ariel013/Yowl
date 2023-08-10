<?php

function createSession($user) {
    // Créez une nouvelle session pour l'utilisateur
    session_start();

    // Stockez l'ID de l'utilisateur dans la session
    $_SESSION['id_user'] = $user->id;

    // Retournez l'ID de l'utilisateur
    return $user->id;
}
