<?php

if(isset($_GET['id']) && !empty($_GET['id'])) {

    include('../../db.php');

    $statement = $bdd->prepare('DELETE FROM INVITE WHERE id = ?');
    $results = $statement->execute([$_GET['id']]);

    if($results){
        echo 'success';
    } else {
        echo 'failure';
    }
}

?>
