<?php

function isPro($id_personne) {
    include('../includes/db.php');

    $q = 'SELECT id FROM PRESTATAIRE WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$id_personne]);

    return count($req->fetchAll()) > 0;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('../includes/common_head.php'); ?>
        <link rel="stylesheet" href="../style/user_manager.css">
    </head>
    <body>
        <?php
            include('../includes/db.php');

            $q = 'SELECT * FROM PERSONNE WHERE id = :id';
            $req = $bdd->prepare($q);
            $req->execute([
                'id' => $_GET['id']
            ]);
            $personne_results = $req->fetchAll(PDO::FETCH_ASSOC);

            $isPro = isPro($_GET['id']);

            if($isPro) {
                $q = 'SELECT * FROM PRESTATAIRE WHERE personne = :id';
                $req = $bdd->prepare($q);
                $req->execute([
                    'id' => $_GET['id']
                ]);
                $specific_results = $req->fetchAll(PDO::FETCH_ASSOC);

            }else {
                $q = 'SELECT * FROM UTILISATEUR WHERE personne = :id';
                $req = $bdd->prepare($q);
                $req->execute([
                    'id' => $_GET['id']
                ]);
                $specific_results = $req->fetchAll(PDO::FETCH_ASSOC);
            }
        ?>

        <main class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Champ</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($personne_results[0] as $key => $value){
                            if($key == 'mot_de_passe'){
                                echo '';
                            }else{
                                echo '<tr>';
                                echo '<td>' . $key . '</td>';
                                echo '<td>' . $value . '</td>';
                                echo '</tr>';
                            }
                        }
                        foreach($specific_results[0] as $key => $value){
                            if($key == 'mot_de_passe'){
                                echo '';
                            }else{
                                echo '<tr>';
                                echo '<td>' . $key . '</td>';
                                echo '<td>' . $value . '</td>';
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </main>

        <script src="scripts/index.js"></script>
    </body>
</html>
