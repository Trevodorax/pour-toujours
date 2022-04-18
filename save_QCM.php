<?php
    session_start();

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

    include('includes/db.php');

    $q = "SELECT id FROM UTILISATEUR WHERE personne = (SELECT id FROM PERSONNE WHERE email = :user_email)";
    $req = $bdd->prepare($q);
    $req->execute([
        'user_email' => $_SESSION['email']
    ]);
    $result = $req->fetchAll()[0][0];
    $user_id = $result;

    // put this in database if everything went right
    $q = "UPDATE UTILISATEUR SET preferences_qcm = :user_pref WHERE id = :user_id";
    $req = $bdd->prepare($q);
    $req->execute([
        'user_pref' => $preferences,
        'user_id' => $user_id
    ]);

    $q = "SELECT id FROM MARIAGE WHERE utilisateur = :user_id";
    $req = $bdd->prepare($q);
    $req->execute([
        'user_id' => $user_id
    ]);

    $wedding_id = $req->fetchAll();

    if(count($wedding_id) == 0){
        // create wedding
        $q = "INSERT INTO MARIAGE (utilisateur) VALUES (". $user_id . ")";
        $req = $bdd->prepare($q);
        $utilisateur = $req->execute([]);
    }

    // header('location: control_pannel.php');
    // exit;

?>
