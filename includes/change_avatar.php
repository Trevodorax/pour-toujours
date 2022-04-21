<?php
session_start();

include('db.php');
$q = "UPDATE UTILISATEUR SET avatar = :newAvatar WHERE personne = :id";
$req = $bdd->prepare($q);
$req->execute([
    'newAvatar' => $_POST['newAvatar'],
    'id' => $_SESSION['id']
]);
?>