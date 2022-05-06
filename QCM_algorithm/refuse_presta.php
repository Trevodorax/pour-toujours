<?php

session_start();
include('../includes/db.php');

// get user id
$q = "SELECT id FROM UTILISATEUR WHERE personne = ?";
$req = $bdd->prepare($q);
$req->execute([$_SESSION['id']]);
$id_utilisateur = $req->fetchAll()[0][0];

// add the rejection to DB
$q = "INSERT INTO REFUSE (utilisateur, service) VALUES (:utilisateur, :service)";
$req = $bdd->prepare($q);
$req->execute([
    'utilisateur' => $id_utilisateur,
    'service' => $_GET['service']
]);

// send back to presta finder to get a new one
header('location: presta_finder.php');
exit;

?>
