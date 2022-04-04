<?php
    try{
        $bdd = new PDO('mysql:host=localhost:3306;dbname=pa2k22', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
?>
