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

        $q ='SELECT PRESTATAIRE.id FROM PRESTATAIRE WHERE personne = ?' ;
        $req = $bdd->prepare($q);
        $req->execute([
            $_GET['id']
            ]);
        $pro_id = $req->fetchAll(PDO::FETCH_ASSOC) ;
        $roleColumn = "PRESTATAIRE" ;

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


    //deleting the personne table
    $q = 'DELETE FROM PERSONNE WHERE id = :id';
        $req = $bdd->prepare($q);
        $req->execute(['id' => $_GET['id'] ]);

    if ($req){
        echo 'Compte supprimé' ;
    } else {
        echo 'erreur lors de la suppression';
    }
}
?>