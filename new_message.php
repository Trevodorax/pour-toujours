<?php
    session_start();
    include('includes/db.php');

    $q = 'SELECT id FROM conversation WHERE personne1 = :id OR personne2 = :id';
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $_SESSION['id']
    ]);
    $conversation = $req->fetchAll();

    $message = $_POST['message'];
    $q = "INSERT INTO message (contenu, conversation, id_auteur) VALUES (:contenu, :conversation, :id_auteur)";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        'contenu' => $message,
        'conversation' => $conversation[0][0],
        'id_auteur' => $_SESSION['id']
    ]);
    $results = $req->fetchAll();

    if(count($results) == 0){
        header('location: control_pannel.php?page=messages&message=Message reçu Capitaine !');
        exit;
    }
?>