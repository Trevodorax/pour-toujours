<?php 

include('db.php');

//Functions sets 
function isCustomer(){
    if(empty($_SESSION['emailPro'])){
        return true;
    }
}
function isLogged(){
    if( isset($_SESSION['email'])) {
        return true;
    }
}
function displayInfo($informations){
    foreach($informations as $key => $pro){
        $id_presta = $pro['id'] ;
        $email_presta = $pro['email'];
        $path = 'images/prestataires';
        echo '
        
            <div class="presta-card">
                <img src="'. $path . '/' . $pro['photoProfil'] . '">
                <div>
                    <h3><a href="pro_profile_for_user.php?pro=' . $id_presta . '">' . $pro['nomPrefere'] . '</a></h3>
                    <h4>' . $pro['metier']. '</h4>
                    <p>Departement : '. $pro['departement'].'</p>
                    <a id="contact" href="control_pannel.php?page=messages&destinataire='. $email_presta .'">Contacter <img src="images/presta_contact_icon.svg"></a>
                </div>
            </div>' ;

            if ( isCustomer() && isLogged()){
                echo '<img src="images/heart_picto.svg">';
            }
        }
    }


    //SORTING AREA
    if (isset($_POST['sort']) && !empty($_POST['sort'])){
        
        //CHANGING THE VALUE OF THE ORDER BY IN THE INCOMING REQUEST
        if ($_POST['sort'] = "time"){
            $sort = 'date_inscription';
        } else if ($_POST['sort'] = "metier"){
            $sort = 'metier';
        } else if ($_POST['sort'] = "alphabet"){
            $sort = 'nomPrefere' ;
        }

        //REQUEST OF ALL PROS but ORDERED:
        $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id ORDER BY ' . $sort ;
        $req = $bdd->query($q);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) == 0){
            echo '<p>Il n\'y a pas encore de prestataire sur le site.</p>';
        }
        displayInfo($results);

    } else if
            //FILTERS AREA   
            (isset($_POST['column_name']) &&
                 isset($_POST['content'])){

           //SETTING THE VALUE OF THE CONDITION
        $column_name = htmlspecialchars($_POST['column_name']);

        $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id WHERE ' . $column_name . '= :content';
        $req = $bdd->prepare($q);
        $req->execute([
            'content' => $_POST['content']
        ]);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) == 0){
            echo '<p class="mt-3">Il n\'y a pas de prestataires correspondant à ce filtre.</p>';
        }
        
        displayInfo($results);
       
 }  else {
       echo '<p>Erreur avec la demande</p>';
  }   
?>