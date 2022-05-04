<?php

    session_start();
    include('includes/db.php');
// checking if fields are filled
if (!isset($_GET['email']) || empty($_GET['email']) || !isset($_GET['cle']) || empty($_GET['cle'])){
    header('location: index.php?message=Il manque des informations requises pour la confirmation du compte');
    exit;
}else{
    // converting using htmlspecialchars to avoid injections
    $email = htmlspecialchars($_GET['email']);
    $getkey = htmlspecialchars($_GET['cle']);
    // checking if the account linking the email is already confirmed
    $q = 'SELECT confirme FROM PERSONNE WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute(array($email));
    $result = $req->fetch();

    if ($result[0] != 1){
        // getting the key corresponding to the email in the database
        $q = 'SELECT cle FROM PERSONNE WHERE email = ?';
        $req = $bdd->prepare($q);
        $req->execute(array($email));
        $bddkey = $req->fetch();
        // checking  if  there's an answer
        if($bddkey[0] != 0){
            // checking if both keys match
            if ($getkey == $bddkey[0]){
                $q = 'UPDATE PERSONNE SET confirme = 1 WHERE email = ? AND cle = ?';
                $req = $bdd->prepare($q);
                $req->execute(array($email, $bddkey[0]));
                header('location: index.php?message=L\'email a bien été confirmé');
                exit;
            }else{
                header('location: index.php?message=Les informations requises pour la confirmation du compte sont invalides');
                exit;
            };
        }else{
            header('location: index.php?message=L`\'email ne correspond à aucun utilisateur');
            exit;
        }
    }else{
        header('location: index.php?message=L`\'email a déjà été confirmé');
        exit;
    }
}
?>
