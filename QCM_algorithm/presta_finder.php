<?php

session_start();
include('../includes/db.php');

// get refused services
$q = 'SELECT service FROM REFUSE WHERE utilisateur = (SELECT id FROM UTILISATEUR WHERE personne = ?)';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['id']]);
$refus = $req->fetchAll(PDO::FETCH_ASSOC);
$services_refus = "(0";
foreach($refus as $id_refus) {
    $services_refus = $services_refus . ', ' . $id_refus['service'];
}
$services_refus = $services_refus . ")";
var_dump($services_refus);

// get user preferences string
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
// get the id of services with the lowest difference between user budget and price
$q = "SELECT id, ABS(:budget - tarif) as difference FROM SERVICE WHERE type = :type AND id NOT IN " . $services_refus . " ORDER BY difference LIMIT 1 ";
$req = $bdd->prepare($q);

$req->execute([
    'budget' => $nourriture_budget,
    'type' => 'N'
]);
$nourriture_service = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $animation_budget,
    'type' => 'A'
]);
$animation_service = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $lieu_budget,
    'type' => 'L'
]);
$lieu_service = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $tenue_budget,
    'type' => 'T'
]);
$tenue_service = $req->fetchAll()[0][0];

$req->execute([
    'budget' => $photos_budget,
    'type' => 'P'
]);
$photos_service = $req->fetchAll()[0][0];

// getting user id
$q = "SELECT id FROM UTILISATEUR WHERE personne = (SELECT id FROM PERSONNE WHERE email = :user_email)";
$req = $bdd->prepare($q);
$req->execute([
    'user_email' => $_SESSION['email']
]);
$user_id = $req->fetchAll()[0][0];

// getting user wedding
$q = "SELECT id FROM MARIAGE WHERE utilisateur = :user_id";
$req = $bdd->prepare($q);
$req->execute([
    'user_id' => $user_id
]);
$user_wedding = $req->fetchAll()[0][0];


// delete any previously stored team from db
$bdd->exec('DELETE FROM DEMANDE WHERE mariage = ' . $user_wedding);

// store these IDs in the DEMANDE table
$q = "INSERT INTO DEMANDE (mariage, service, statut) VALUES(:mariage, :service, 'propose')";
$req = $bdd->prepare($q);
$req->execute([
    'mariage' => $user_wedding,
    'service' => $nourriture_service
]);

$req->execute([
    'mariage' => $user_wedding,
    'service' => $animation_service
]);

$req->execute([
    'mariage' => $user_wedding,
    'service' => $lieu_service
]);

$req->execute([
    'mariage' => $user_wedding,
    'service' => $tenue_service
]);

$req->execute([
    'mariage' => $user_wedding,
    'service' => $photos_service
]);


// redirect at the end
header("location: ../control_pannel.php");
exit;

?>
