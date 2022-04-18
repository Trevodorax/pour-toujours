<?php

session_start();

// get this in db with a table of refused services per user
$services_refus = "(0, 1, 73)";

// get user preferences string
include('../includes/db.php');

$q = 'SELECT preferences_QCM FROM utilisateur WHERE personne = (SELECT id FROM personne WHERE email = :email)';
$req = $bdd->prepare($q);
$req->execute([
    'email' => $_SESSION['email'],
]);
$preferences = $req->fetchAll()[0][0];

// get budget
$budget_cases = [
    '0' => 2000,
    '1' => 4000,
    '2' => 6000,
    '3' => 8000
];

$budget = $budget_cases[$preferences[2]];

// get number of guests
$guests_cases = [
    '0' => 20,
    '1' => 50,
    '2' => 100,
    '3' => 200
];

$nb_guests = $guests_cases[$preferences[8]];


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

$nourriture_budget = ($budget * $nourriture_part) / $nb_guests;
$animation_budget = $budget * $animation_part;
$lieu_budget = $budget * $lieu_part;
$tenue_budget = $budget * $tenue_part;
$photos_budget = $budget * $photos_part;


/* GET THE RIGHT PRESTAS FOR USER PREFERENCES */
// get the elements with the lowest difference between user budget and price
$q = "SELECT id, ABS(:budget - tarif) as difference FROM SERVICE WHERE type = :type AND id NOT IN" . $services_refus . "ORDER BY difference LIMIT 1 ";
$req = $bdd->prepare($q);

$req->execute([
    'budget' => $nourriture_budget,
    'type' => 'N'
]);
$nourriture_services = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $animation_budget,
    'type' => 'A'
]);
$animation_services = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $lieu_budget,
    'type' => 'L'
]);
$lieu_services = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $tenue_budget,
    'type' => 'T'
]);
$tenue_services = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $photos_budget,
    'type' => 'P'
]);
$photos_services = $req->fetchAll()[0][0];


header("location: ../control_pannel.php?page=home&N=$nourriture_services&A=$activite_services&L=$lieu_services&T=$tenue_services&P=$photos_services");
exit;

?>
