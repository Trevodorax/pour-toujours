<?php 
include('includes/db.php');

if (isset($_GET["id"]) && !empty($_GET['id'])) {

    if (isset($_GET['role']) && $_GET['role'] == 1){

    //IF THE USER IS A CUSTOMER :

        $q ='SELECT UTILISATEUR.id FROM UTILISATEUR WHERE personne = ?' ;
                        $req = $bdd->prepare($q);
                        $req->execute([
                            $_GET['id']
                            ]);
            $user_id = $req ->fetchAll(PDO::FETCH_ASSOC);
            $roleColumn = "UTILISATEUR" ;

        //DELETING HIS MARIAGE
        //DELETING HIS FAVS
        $columnsToDelete = ["FAVORI","MARIAGE"];

        foreach($columnsToDelete as $column){
            $q = 'DELETE FROM '. $column . ' WHERE utilisateur = ?' ;
            $req = $bdd->prepare($q);
            $req->execute([($user_id[0]['id'])]);
            }

        //NOT DELETING REVIEWS THEY GAVE

    } else {
        //IF THE USER IS A PRO : 

        $q ='SELECT PRESTATAIRE.id, photoProfil FROM PRESTATAIRE, PERSONNE WHERE personne = ? and PRESTATAIRE.personne = PERSONNE.id' ;
        $req = $bdd->prepare($q);
        $req->execute([
            $_GET['id']
            ]);
        $pro_id = $req->fetchAll(PDO::FETCH_ASSOC) ;
        $roleColumn = "PRESTATAIRE" ;
        var_dump($pro_id);

        //DELETING HIS SERVICES
        // HIS PORTFOLIO,
        // HIS REVIEWS 
        $columnsToDelete = ["COMMENTAIRE","SERVICE", "PORTFOLIO_IMAGES"];
        
        foreach($columnsToDelete as $column){
            $q = 'DELETE FROM '. $column . ' WHERE prestataire = ?' ;
            $req = $bdd->prepare($q);
            $req->execute([$pro_id[0]['id']]);
            }

        }

    //DELETING MESSAGE / id_auteur personne: so the other person can still see their message but not this deleted_user's

    $q = 'DELETE FROM MESSAGE WHERE id_auteur = ?' ;
    $req = $bdd->prepare($q);
    $req->execute([$_GET['id']]);
    

    //If everything is ok, the last step is deleting those table

     //DELETING THE CUSTOMER TABLE
    
     $q = 'DELETE FROM '. $roleColumn . ' WHERE personne = ?' ;
     $req = $bdd->prepare($q);
     $req->execute([
         $_GET['id']
         ]);


         //DELETING THE IMAGES SAVED ON THE SERVER : 

         $imagesToDelete = ["images/portfolios/" . $pro_id[0]['id'] . "/", ($pro_id[0]['photoProfil'] == 'default_pp.jpg') ? " " : "images/prestataires/" . $pro_id[0]['photoProfil']] ;
         foreach($imagesToDelete as $image)
         if (file_exists($image)){
             $test = unlink($image);
         }


    //deleting the personne table
    $q = 'DELETE FROM PERSONNE WHERE id = :id';
        $req = $bdd->prepare($q);
        $req->execute(['id' => $_GET['id'] ]);

    if ($req){
        echo 'Compte supprimé' ;
    } else {
        echo 'Erreur lors de la suppression';
    }

    //Logging the user out.
    include('log_out.php');
}
?>