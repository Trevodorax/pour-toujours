<?php
session_start();


include('../../db.php');

$q = "SELECT id, nomComplet, email FROM INVITE WHERE invitePar = ? ";
$req = $bdd->prepare($q);
$req->execute([
    $_SESSION['id']
]);
$results = $req->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $invite) {
    echo '<tr>';
    echo '<td>' . $invite['nomComplet'] . '</td>';
    echo '<td>' . $invite['email'] . '</td>';
    echo '<td><button class="btn btn-danger" onclick="deleteGuest(' . $invite['id'] . ', this)">Supprimer</button></td>';
    echo '</tr>';
}

?>