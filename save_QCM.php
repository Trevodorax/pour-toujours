<?php

    $religion = $_POST['religion'];
    $assistance = $_POST['assistance'];
    $budget = $_POST['budget'];
    $nourriture = $_POST['nourriture'];
    $animation = $_POST['animation'];
    $lieu = $_POST['lieu'];
    $tenue = $_POST['tenue'];
    $photos = $_POST['photos'];
    $nb_invites = $_POST['nb_invites'];

    $preferences = strval($religion) . strval($assistance) . strval($budget) . strval($nourriture) . strval($animation) . strval($lieu) . strval($tenue) . strval($photos) . strval($nb_invites);

    // checking that nothing went wrong or was modified
    if(strlen($preferences) != 9){
        header('location: QCM.php?erreur=mauvaise saisie');
        exit;
    }

    for($i = 0; $i < 10; $i++){
        if(!in_array($preferences[$i], ['0', '1', '2', '3'])){
            header('location: QCM.php?erreur=mauvaise saisie');
            exit;
        }
    }


    // put this in database if everything went right
    include('includes/db.php');
    $q = "UPDATE UTILISATEUR SET preferences = :user_pref";
    $req = $bdd->prepare($q);
    $result = $req->execute([
        'user_pref' => $preferences
    ]);

    var_dump($result);

?>

