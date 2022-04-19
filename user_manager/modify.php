<?php

    session_start();
    //! check if user is admin

    $personne_columns = ['nomComplet', 'nomPrefere', 'date_naissance', 'genre', 'email', 'numero_tel', 'departement', 'date_inscription', 'estAdmin'];
    $prestataire_columns = ['nomEntreprise', 'telPro', 'emailPro', 'metier', 'description', 'photoProfil', 'lienSiteWeb'];
    $utilisateur_columns = ['preferences_qcm', 'avatar'];

    $modified_table = (in_array($_POST['column'], $personne_columns) ? 'PERSONNE' : (in_array($_POST['column'], $prestataire_columns) ? 'PRESTATAIRE' : ((in_array($_POST['column'], $utilisateur_columns) ? 'UTILISATEUR' : 'ERREUR'))));
    if($modified_table == 'ERREUR'){
        header('location: consult.php?id=' . $_POST['id']);
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
                'id' => $_POST['id']
            ]);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <main class="container">
            <form>
                <?php

                var_dump($modified_table);
                var_dump($_POST['id']);
                var_dump($_POST['column']);
                var_dump($_POST['new_content']);

                ?>
                </form>
        </main>

        <script src="scripts/index.js"></script>
    </body>
</html>
