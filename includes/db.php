<?php
    try{
        $bdd = new PDO('mysql:host=localhost:3306;dbname=POURTOUJOURS', 'TOUJOURS', 'Respons11', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
?>
