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
// nourriture 10 points
$nourriture_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$nourriture = $nourriture_array[$preferences[3]];

// animation 5 points
$animation_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$animation = $animation_array[$preferences[4]];

// lieu 15 points
$lieu_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$lieu = $lieu_array[$preferences[5]];

// tenue 10 points
$tenue_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$tenue = $tenue_array[$preferences[6]];

// photos 5 points
$photos_array = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$photos = $photos_array[$preferences[7]];

?>