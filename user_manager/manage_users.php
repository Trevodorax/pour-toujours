<?php
session_start();
include('../includes/db.php');

// check if person is admin
if(!isset($_SESSION['id'])){
    header('location: ../index.php');
    exit;
}

$q = 'SELECT estAdmin FROM PERSONNE WHERE id = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['id']]);

$estAdmin = $req->fetchAll()[0][0];
if($estAdmin != '1') {
    header('location: ../index.php');
    exit;
}

function isPro($id_personne){
    include('../includes/db.php');

    $q = 'SELECT id FROM PRESTATAIRE WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$id_personne]);

    return count($req->fetchAll()) > 0;
}

?>

<?php
    include('user_manager_header.php');

    $q = 'SELECT id, nomComplet, estAdmin FROM PERSONNE';
    $req = $bdd->query($q);
    $results = $req->fetchAll(PDO::FETCH_ASSOC);
?>

        <main class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($results as $key => $personne){
                            echo '<tr class=' . ($personne['estAdmin'] ? 'admin-row ' : '') . (isPro($personne['id']) ? 'pro-row' : 'user-row') .'>';
                            echo '<td>' . $personne['nomComplet'] . '</td>';
                            echo '<td>' . (isPro($personne['id']) ? 'Prestataire' : 'Utilisateur') . '</td>';
                            echo '<td>';
                            echo '<a href="consult.php?id=' . $personne['id'] . '"><img src="../images/pen_picto.svg"></a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="delete.php?id=' . $personne['id'] . '"><img src="../images/go_icon.svg"></a>';
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
