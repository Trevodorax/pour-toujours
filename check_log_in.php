<?php

    include('includes/db.php');

    if(!isset($_POST['email']) || empty($_POST['email'])){
        header('location: log_in.php?message=Vous devez remplir le champ e-mail');
        exit;
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('location: log_in.php?message=Email invalide');
        exit;
    }

    if(!isset($_POST['password']) || empty($_POST['password'])){
        header('location: log_in.php?message=Vous devez remplir le champ mot de passe');
        exit;
    }

    $q = 'SELECT id FROM personne WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $_POST['email']
    ]);
    $results = $req->fetchAll();
    if(count($results) == 0){
        header ('location: log_in.php?message=Email inexistant');
        exit;
    }

    $q = 'SELECT id FROM personne WHERE mot_de_passe = :password';
    $req = $bdd->prepare($q);
    $req->execute([
        'password' => hash('sha512', $_POST['password'])
    ]);
    $results = $req->fetchAll();
    if(count($results) == 0){
        header ('location: log_in.php?message=Mot de passe incorrect');
        exit;
    }

    session_start();
    $_SESSION['email'] = $_POST['email'];
    header('location: index.php?message=Connecté avec succès');
    exit;

?>