<?php 

include('includes/db.php');

if (isset($_GET["id"]) && !empty($_GET['id'])) {
    $q = 'DELETE FROM PERSONNE WHERE id = :id';
        $req = $bdd->prepare($q);
        $req->execute(['id' => $_GET['id'] ]);

//Missing the deletion of the related data

    if ($req){
        echo 'Compte supprimé' ;
    } else {
        echo 'erreur lors de la suppression';
    }
}
?>