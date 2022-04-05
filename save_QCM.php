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

    // put this in database if everything went right
    include('includes/db.php');
    $q = "UPDATE UTILISATEUR SET preferences_qcm = :user_pref WHERE personne = (SELECT id FROM PERSONNE WHERE email = :user_email)";
    $req = $bdd->prepare($q);
    $result = $req->execute([
        'user_pref' => $preferences,
        'user_email' => $_SESSION['email']
    ]);

    header('location: control_pannel.php');
    exit;

?>

