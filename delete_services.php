<?php 
session_start();
include('includes/db.php');

if(isset($_GET['column']) && !empty($_GET['column'])
    && isset($_GET['id_service']) && !empty($_GET['id_service'])
        && isset($_GET['id_presta']) && !empty($_GET['id_presta'])
    ) {

        //REQUEST TO DELETE 

        $q ='DELETE FROM '. strtoupper(htmlspecialchars($_GET['column'])) . ' WHERE id = :id AND prestataire = :prestataire';
        $req = $bdd->prepare($q);
        $req -> execute([
            'id' => (int) htmlspecialchars($_GET['id_service']),
            'prestataire' => (int) htmlspecialchars($_GET['id_presta'])      
        ]);

        if ($req){
            echo 'Suppression réussie' ;
        }
    }
    else {
        echo 'Erreur :/';
    }
?>

