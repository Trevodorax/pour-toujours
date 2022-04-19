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

    // possible columns per table
    $personne_columns = ['nomComplet', 'nomPrefere', 'date_naissance', 'genre', 'email', 'numero_tel', 'departement', 'date_inscription', 'estAdmin'];
    $prestataire_columns = ['nomEntreprise', 'telPro', 'emailPro', 'metier', 'description', 'photoProfil', 'lienSiteWeb'];
    $utilisateur_columns = ['preferences_qcm', 'avatar'];

    // get which table is modified or exit if wrong column type
    $modified_table = (in_array($_POST['column'], $personne_columns) ? 'PERSONNE' : (in_array($_POST['column'], $prestataire_columns) ? 'PRESTATAIRE' : ((in_array($_POST['column'], $utilisateur_columns) ? 'UTILISATEUR' : 'ERREUR'))));
    if($modified_table == 'ERREUR'){
        header('location: consult.php?id=' . $_POST['id']);
        exit;
    }

    // modify the user using all these informations

    $q = "UPDATE " . $modified_table . " SET " . $_POST['column'] . " = :new_content WHERE id = :id ";
    $req = $bdd->prepare($q);
    try{
        $req->execute([
            'new_content' => $_POST['new_content'],
            'id' => $_POST['id']
        ]);
    } catch(PDOException $e) {
        header('location: consult.php?id=' . $_POST['id'] . '&result=fail');
        exit;
    }

    header('location: consult.php?id=' . $_POST['id'] . '&result=success');
    exit;


?>
