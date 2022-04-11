<?php
    session_start();
    include('includes/db.php');

    $destinataire = htmlspecialchars($_POST['destinataire']);

    $q = 'SELECT id FROM conversation WHERE (personne1 = ? AND personne2 = ?) OR (personne1 = ? AND personne2 = ?)';
    $req = $bdd->prepare($q);
    $req->execute([
        $destinataire,
        $_SESSION['id'],
        $_SESSION['id'],
        $destinataire
    ]);
    $conversation = $req->fetchAll();

    $message = htmlspecialchars($_POST['message']);

    $q = "INSERT INTO message (contenu, conversation, id_auteur) VALUES (:contenu, :conversation, :id_auteur)";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        'contenu' => $message,
        'conversation' => $conversation[0][0],
        'id_auteur' => $_SESSION['id']
    ]);
    $results = $req->fetchAll();

    if(count($results) == 0){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
?>