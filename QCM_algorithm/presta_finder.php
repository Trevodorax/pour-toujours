<?php
session_start();

// get user preferences string
include('includes/db.php');

$q = 'SELECT preferences_QCM FROM utilisateur WHERE personne = (SELECT id FROM personne WHERE email = :email)';
$req = $bdd->prepare($q);
$req->execute([
    'email' => $_SESSION['email'],
]);
$preferences = $req->fetchAll();

var_dump($preferences);



?>