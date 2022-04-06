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
    $q = "INSERT INTO message (contenu, conversation) VALUES (:contenu, :conversation)";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        'contenu' => $message,
        'conversation' => $conversation[0][0]
    ]);

    if
?>