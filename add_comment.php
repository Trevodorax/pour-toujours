<?php 

session_start();
include('includes/db.php');

if (isset($_GET['pro']) && !empty($_GET['pro'])
        && isset($_GET['id']) && !empty($_GET['id'])) {

     
    //Cheking if review form is OK:

        if(!isset($_POST['content']) || empty($_POST['content'])
            || !isset($_POST['grade']) || empty($_POST['grade']) ) {
                
                header('location: pro_profile.php?message=Vous devez remplir le champ') ;
                exit ;
            }




    //What is user's id ? 
    
    $q ='SELECT UTILISATEUR.id FROM UTILISATEUR WHERE personne = ?' ;
    $req = $bdd->prepare($q);
    $req->execute([
        htmlspecialchars($_GET['id'])
        ]);
    $user_id = $req ->fetchAll(PDO::FETCH_ASSOC);
    
    
    //Save the comment

    $q ='INSERT INTO COMMENTAIRE(contenu,note,prestataire,utilisateur,valide) VALUES (?,?,?,?,?)' ;
    $req = $bdd->prepare($q);
    $req->execute([
        htmlspecialchars($_POST['content']),
        htmlspecialchars($_POST['grade']),
        htmlspecialchars($_GET['pro']),
        $user_id[0]['id'],
        1
        ]);

        if ($req) {
            header('location: pro_profile_for_user.php?pro=' . htmlspecialchars($_GET['pro']) . '&message=Commentaire ajouté avec succès.');
            exit;
        }

    } else {
        header('location: pro_profile.php?pro='. htmlspecialchars($_GET['pro']) . '&message=Il y a eu une erreur.') ;
        exit;
    }
?>
