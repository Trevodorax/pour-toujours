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
            if(count($specific_results) == 0){
                $specific_results = [['aucun']];
            }
        ?>

        <main class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Champs généraux</th>
                        <th>Valeurs</th>
                        <th>Nouvelle valeur</th>
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

                                echo '<td>';
                                if($key != 'id'){
                                    echo '<form action="modify.php" method="POST">';
                                        echo '<input type="text" name="new_content" placeholder="Nouvelle valeur">';
                                        echo '<input type="hidden" name="column" value="' . $key . '">';
                                        echo '<button type="submit" name="id" value="' . $_GET['id'] . '"><img src="../images/pen_picto.svg"></button>';
                                    echo '</form>';
                                }
                                echo '</td>';

                                echo '</tr>';
                            }
                        }
                    ?>


                    <tr>
                        <th>Champs spécifiques</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        foreach($specific_results[0] as $key => $value){
                            echo '<tr>';
                            echo '<td>' . $key . '</td>';

                            echo '<td>' . $value . '</td>';

                            echo '<td>';
                            if($key != 'id' && $key != 'personne'){
                                echo '<form action="modify.php" method="POST">';
                                    echo '<input type="text" name="new_content" placeholder="Nouvelle valeur">';
                                    echo '<input type="hidden" name="column" value="' . $key . '">';
                                    echo '<button type="submit" name="id" value="' . $_GET['id'] . '"><img src="../images/pen_picto.svg"></button>';
                                echo '</form>';
                            }
                            echo '</td>';

                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </main>

        <script src="scripts/index.js"></script>
    </body>
</html>
