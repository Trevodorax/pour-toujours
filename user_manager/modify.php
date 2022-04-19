<?php

    session_start();
    //! check if user is admin

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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Champ</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($results[0] as $key => $value){
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
