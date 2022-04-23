<?php 
session_start();
include('includes/db.php');

//CHECKING INPUTS ( same checkings as in check-sign-up.php)

$posts = ['new_value', 'column'] ;
foreach($posts as $post){

    if(!isset($_POST[$post]) || empty($_POST[$post])){
        header('location: settings.php?message=Vous devez remplir le champ ' . $post );
        exit;
    }
    
}

//SPECIAL INPUTS : 

    //COMMENT GERER DEPARTEMENT ET IMAGE ET GENRE ?



//Updating the db : thx modify.php
////PARAMETERS FOR THE REQUEST
$personne_columns = ['nomComplet', 'nomPrefere', 'date_naissance', 'genre', 'email', 'numero_tel', 'departement', 'date_inscription'];
$prestataire_columns = ['nomEntreprise', 'telPro', 'emailPro', 'metier', 'description', 'photoProfil', 'lienSiteWeb'];

$modified_table = (in_array($_POST['column'], $personne_columns) ? 'PERSONNE' : (in_array($_POST['column'], $prestataire_columns) ? 'PRESTATAIRE' : 'ERREUR'));

if($modified_table == 'ERREUR'){
    header('location: settings.php?');
    exit;
} else {

    $condition_col = ($modified_table == 'PERSONNE') ? 'id' : 'personne' ;
}

$column = $_POST['column'];

var_dump($modified_table, $column);

//REQUEST
$q = 'UPDATE ' . $modified_table . ' SET ' . $column . ' = :new_value WHERE ' . $condition_col . ' = :personne' ;
$req = $bdd->prepare($q);
try{
    $req->execute([
        'new_value' => $_POST['new_value'],
        'personne' => $_SESSION['id']
    ]);
} catch(PDOException $e) {

    header('location: settings.php?result=fail');
    exit;
}

if (isset($_SESSION[$column])){
    $_SESSION[$column] = $_POST['new_value'] ;
}

header('location: settings.php?result=success');
exit;

?>