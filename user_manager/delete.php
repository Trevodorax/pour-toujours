<?php
function isPro($id_personne){
    include('../includes/db.php');

    $q = 'SELECT id FROM PRESTATAIRE WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$id_personne]);

    return count($req->fetchAll()) > 0;
}
?>



<?php
    session_start();
    include('../includes/db.php');

    // check if person is admin
    if(!isset($_SESSION['id'])){
        header('location: manage_users.php');
        exit;
    }

    $q = 'SELECT estAdmin FROM PERSONNE WHERE id = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_SESSION['id']]);

    $estAdmin = $req->fetchAll()[0][0];
    if($estAdmin != '1') {
        header('location: manage_users.php');
        exit;
    }

    // delete from db if the person is an admin
    $q = "DELETE FROM PERSONNE WHERE id = :id";
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $_GET['id']
    ]);

    if(isPro($_GET['id'])) {
        $q = "DELETE FROM PRESTATAIRE WHERE personne = :id";
        $req = $bdd->prepare($q);
        $req->execute([
            'id' => $_GET['id']
        ]);
    }else{
        $q = "DELETE FROM UTILISATEUR WHERE personne = :id";
        $req = $bdd->prepare($q);
        $req->execute([
            'id' => $_GET['id']
        ]);
    }

    header('location: manage_users.php');
    exit;
?>
