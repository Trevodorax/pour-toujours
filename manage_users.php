



<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
    </head>
    <body>
        <?php
            include('includes/db.php');

            $q = 'SELECT id, nomComplet, email FROM PERSONNE';
            $req = $bdd->query($q); //exécute la requête $q
            $results = $req->fetchAll(PDO::FETCH_ASSOC); // renvoie un tableau contenant tous les résultats
        ?>

        <main>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($results as $key => $user){
                            echo '<tr>';
                            echo '<td>' . $user['nomComplet'] . '</td>';
                            echo '<td>' . $user['email'] . '</td>';
                            echo '<td>';
                            echo '<a  class="btn btn-sm btn-primary me-2" href="consulter.php?id=' . $user['id'] . '">Consulter</a>';
                            echo '<a class="btn btn-sm btn-warning me-2" href="modifier.php?id=' . $user['id'] . '">Modifier</a>';
                            echo '<a class="btn btn-sm btn-danger" href="supprimer.php?id=' . $user['id'] . '">Supprimer</a>';
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
