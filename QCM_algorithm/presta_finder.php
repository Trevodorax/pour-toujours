<?php

session_start();

// get user preferences string
include('../includes/db.php');

$q = 'SELECT preferences_QCM FROM utilisateur WHERE personne = (SELECT id FROM personne WHERE email = :email)';
$req = $bdd->prepare($q);
$req->execute([
    'email' => $_SESSION['email'],
]);
$preferences = $req->fetchAll()[0][0];


// get budget
$budget_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$budget = $budget_array[$preferences[2]];


/* FIGURING OUT DIVISION OF BUDGET IN 5 PARTS */
// nourriture 1 points
$nourriture = ((4 - (int)$preferences[3])) * 1;

// animation 1 points
$animation = ((4 - (int)$preferences[4])) * 1;

// lieu 3 points
$lieu = ((4 - (int)$preferences[5])) * 4;

// tenue 2 points
$tenue = ((4 - (int)$preferences[6])) * 2;

// photos 1 points
$photos = ((4 - (int)$preferences[7])) * 1;


$diviseur = $nourriture + $animation + $lieu + $tenue + $photos;
$nourriture_part = (float)$nourriture / $diviseur;
$animation_part = (float)$animation / $diviseur;
$lieu_part = (float)$lieu / $diviseur;
$tenue_part = (float)$tenue / $diviseur;
$photos_part = (float)$photos / $diviseur;

$nourriture_budget = $budget * $nourriture_part;
$animation_budget = $budget * $animation_part;
$lieu_budget = $budget * $lieu_part;
$tenue_budget = $budget * $tenue_part;
$photos_budget = $budget * $photos_part;

// see the values of budget for everything
// var_dump($nourriture_budget);
// var_dump($animation_budget);
// var_dump($lieu_budget);
// var_dump($tenue_budget);
// var_dump($photos_budget);


/* GET THE RIGHT PRESTAS FOR USER PREFERENCES */
// get the 3 elements with the lowest difference between user budget and budget
$q = 'SELECT id, tarif, ABS(:budget - tarif) as difference FROM SERVICE ORDER BY difference LIMIT 2 ';
$req = $bdd->prepare($q);
$req->execute([
    'budget' => $nourriture_budget
]);
$nourriture_services = $req->fetchAll();


?>