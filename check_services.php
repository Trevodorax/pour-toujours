<?php
session_start();
include('includes/db.php');


if(!isset($_POST['title']) || empty($_POST['title']) ){
        header('location: pro_profile.php?message=Vous devez remplir tous les champs');
        exit;
    } else{
        setcookie('service', $_POST['title'], time() + 24 * 60 * 60);
    }

    $q ='INSERT INTO SERVICE(nom,tarif,description,prestataire) VALUES (:nom, :tarif, :description, :prestataire)';
    $req = $bdd->prepare($q);
    $req -> execute([
        'nom' => $_POST['title'],
        'tarif' => $_POST['price'],
        'description' => $_POST['description'],
        'prestataire' => $_SESSION['id']
    ]);

header('location: pro_profile.php?message=Service créé avec succès !');
exit;
  