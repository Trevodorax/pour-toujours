<?php 
session_start();
//This file receives informations from draw_signature.js and will save it in the db

include('includes/db.php');

if (isset($_POST['sign']) && !empty($_POST['sign'])){

    $signbase64 = ($_POST['sign']);
    echo $signbase64;
    $path = '/images/prestataires/signatures/';
    if(!file_exists($path)){
        mkdir($path, 0777,true);
    }
     
    //Transforming the string to get the image content
    $beforeSign = explode(';',$signbase64);
    $transformSign = explode(',' , $beforeSign[1]);
    $signature = base64_decode($transformSign[1]) ;

    $filename = $path . 'signature-'. time() .'.png';

     // saving the signature in the db : update because you can change ur signature.
     $q = "UPDATE prestataire SET signature = :signature WHERE personne = 1";
     $req = $bdd->prepare($q);
     $results = $req->execute([
         'signature' => $filename,
        //  'personne' => $_SESSION['id']
     ]);

    $success = file_put_contents(__DIR__.$filename , $signature);
 
} else {
    echo 'il manque des parametres';
}
?>