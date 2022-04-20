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
    include('db.php');

    $q = 'SELECT id, estAdmin, nomComplet FROM PERSONNE WHERE nomComplet LIKE :searchedText';
    $req = $bdd->prepare($q);
    $req->execute(['searchedText' => ('%' . $_POST['searchedText'] . '%')]);
    $results = $req->fetchAll();

    foreach($results as $result){
        echo "{";
            echo "id: ";
            echo $result['id'];
            echo ", ";
            echo "estAdmin: ";
            echo $result['estAdmin'];
            echo ", ";
            echo "nomComplet: ";
            echo $result['nomComplet'];
            echo ", ";
            echo "estPro: ";
            echo isPro($result['id']);
        echo "}";
        echo "\n";
    }
?>
