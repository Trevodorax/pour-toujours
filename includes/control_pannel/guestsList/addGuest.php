<?php

session_start();

include('../../db.php');

$query = "INSERT INTO INVITE (nomComplet, email, invitePar) VALUES (?, ?, ?)";
$statement = $bdd->prepare($query);
$res = $statement->execute([
    $_POST['nomComplet'],
    $_POST['email'],
    $_SESSION['id']
]);

echo ($res);

?>
