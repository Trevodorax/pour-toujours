<?php
    session_start();
    include('includes/db.php');
    $email = htmlspecialchars($_POST['email']);
    $q = 'SELECT id, email FROM personne WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $email
    ]);
    $id = $req->fetchAll();

    if(count($id) == 0){
        header('location: control_pannel.php?page=messages&message=L\'email n\'existe pas');
        exit;
    }

    $q = "INSERT INTO conversation (personne1, personne2) VALUES (:personne1, :personne2)";
    $req = $bdd->prepare($q);
    $results = $req->execute([
        'personne1' => $_SESSION['id'],
        'personne2' => $id[0][0]
    ]);

    header('location: control_pannel.php?page=messages&message=Conversation créée&destinataire=' . $id[0][1]);
    exit;
?>
