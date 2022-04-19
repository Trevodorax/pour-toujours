<?php

    session_start();
    //! check if user is admin

    $personne_columns = ['nomComplet', 'nomPrefere', 'date_naissance', 'genre', 'email', 'numero_tel', 'departement', 'date_inscription', 'estAdmin'];
    $prestataire_columns = ['nomEntreprise', 'telPro', 'emailPro', 'metier', 'description', 'photoProfil', 'lienSiteWeb', 'personne'];
    $utilisateur_columns = ['preferencesQCM', 'avatar', 'personne'];

    $modified_table = (in_array($_GET['column'], $personne_columns) ? 'PERSONNE' : (in_array($_GET['column'], $prestataire_columns) ? 'PRESTATAIRE' : ((in_array($_GET['column'], $utilisateur_columns) ? 'UTILISATEUR' : 'ERREUR'))));
    if($modified_table == 'ERREUR'){
        header('location: consult.php?id=' . $_GET['id']);
        exit;
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <?php include('../includes/common_head.php'); ?>
    </head>
    <body>
        <?php
            include('../includes/db.php');

            $q = 'SELECT * FROM PERSONNE WHERE id = :id';
            $req = $bdd->prepare($q);
            $req->execute([
                'id' => $_GET['id']
            ]);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <main class="container">
            <form>

            </form>
        </main>

        <script src="scripts/index.js"></script>
    </body>
</html>
