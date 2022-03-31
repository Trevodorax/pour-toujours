<?php

    if(!isset($_SESSION['email'])){
        header('location: index.php?message=Vous devez vous connecter');
    }

?>