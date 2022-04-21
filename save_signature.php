<?php 
//This file receives informations from draw_signature.js and will save it in the db

include('includes/db.php');

if (isset($_POST['sign']) && !empty($_POST['sign'])){
    $signature = $_POST['sign'];

     // creating a new person if everything looks nice
     $q = "INSERT INTO prestataire(signature) VALUES (:signature)";
     $req = $bdd->prepare($q);
     $results = $req->execute([
         'signature' => $signature,
     ]);
}
if ($results){
    $path = 'images/prestataires/signatures';
    if(!file_exists($path)){
        mkdir($path, 0777,true);
    }

    $filename = base64_decode($signature) ;

    file_put_contents($path.$filename , $filename);

}
?>