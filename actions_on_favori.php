<?php 

include('includes/db.php');

if (isset($_POST['pro']) && !empty($_POST['pro']) 
    || isset($_POST['customer']) && !empty($_POST['customer'])
    || isset($_POST['action']) && !empty($_POST['action'])){
        
        //Finding the id of the customer from the 'utilisateur table'
        
        $q ='SELECT UTILISATEUR.id FROM UTILISATEUR WHERE personne = ?' ;
        $req = $bdd->prepare($q);
        $req->execute([
            htmlspecialchars($_POST['customer'])
            ]);
        
        $id_customer = $req->fetchAll(PDO::FETCH_ASSOC);
        
        if ($req) {
            if (count($id_customer) != 1){
                echo 'Il y a eu un problème.';
            } else {      
            echo 'OK 1';
            }
        }


        if($_POST['action'] == "add") {
            //Creating the favorite in the DB 
            $q = 'INSERT INTO FAVORI VALUES (?, ?)';

        } else if($_POST['action'] == "delete") {
            //Statement to delete the association
            $q = 'DELETE FROM FAVORI WHERE PRESTATAIRE = ? AND utilisateur = ?';
        }
        
            $req = $bdd->prepare($q);
            $req->execute([
                htmlspecialchars($_POST['pro']),
                $id_customer[0]['id']
                ]);
            
                if ($req) {
                    echo 'Action réalisée avec succès';
                } else {
                    echo "erreur";
                }
        
        
        
}
?>