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
            <section id="filters">
                <h3>Filtres</h3>
                <form onsubmit="return searchPersonne()">
                    <div>
                        <input type="text" name="research" placeholder="Rechercher un utilisateur" id="searchedText">
                        <br><input type=radio name="user-type" value="all" onchange="changeUserType(this)"> Tout voir
                        <br><input type=radio name="user-type" value="users" onchange="changeUserType(this)"> Utilisateurs
                        <br><input type=radio name="user-type" value="prestas" onchange="changeUserType(this)"> Prestataires
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </section>
            <section id="users-table">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Rôle</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody id="usersTable">
                    </tbody>
                </table>
            </section>
        </main>

        <script src="../scripts/manage_users.js"></script>
    </body>
</html>
