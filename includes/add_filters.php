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


    if(isset($_POST['column_name']) &&
       isset($_POST['content'])
       ){
        $column_name = $_POST['column_name'];

        $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id WHERE ' . $column_name . '= :content';
        $req = $bdd->prepare($q);
        $req->execute([
            'content' => $_POST['content']
        ]);
        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) == 0){
            echo '<p class="mt-3">Il n\'y a pas de prestataires correspondant à ce filtre.</p>';
        }
 
        foreach($results as $key => $pro){
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
       
 }  else {
       echo '<p>Pas de filtres dispo</p>';
  }   
?>