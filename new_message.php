<?php
    session_start();
    include('includes/db.php');

    $destinataire = htmlspecialchars($_POST['destinataire']);

    $q = 'SELECT id FROM CONVERSATION WHERE (personne1 = ? AND personne2 = ?) OR (personne1 = ? AND personne2 = ?)';
    $req = $bdd->prepare($q);
    $req->execute([
        $destinataire,
        $_SESSION['id'],
        $_SESSION['id'],
        $destinataire
    ]);
    $conversation = $req->fetchAll();

    $message = htmlspecialchars($_POST['message']);

    $now = date('Y-m-d H:i:s', time());

    $q = "INSERT INTO MESSAGE (contenu, heure_envoi, conversation, id_auteur) VALUES (:contenu, :heure_envoi, :conversation, :id_auteur)";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        'contenu' => $message,
        'heure_envoi' => $now,
        'conversation' => $conversation[0][0],
        'id_auteur' => $_SESSION['id']
    ]);

    $q = "UPDATE CONVERSATION SET dernier_message = ? WHERE ((personne1 = ? AND personne2 = ?) OR (personne1 = ? AND personne2 = ?))";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        $now,
        $destinataire,
        $_SESSION['id'],
        $_SESSION['id'],
        $destinataire
    ]);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

?>