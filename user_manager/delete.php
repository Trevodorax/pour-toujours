<?php
    session_start();

    // check if user is admin

    $id = $_GET['id'];

    include('../includes/db.php');

    $q = "DELETE FROM PERSONNE WHERE id = :id";
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $id
    ]);
?>
