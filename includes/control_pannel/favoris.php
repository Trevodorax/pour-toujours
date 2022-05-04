

<?php

//FUNCTIONS NEEDED :

function displayInfo($informations){
    echo '<section id="all-presta">';
    foreach($informations as $key => $pro){
        $id_presta = $pro['id'] ;
        $email_presta = $pro['email'];
        $path = 'images/prestataires';
        echo '  <div class="presta-card-heart">
        
            <div class="presta-card">
                <img src="'. $path . '/' . $pro['photoProfil'] . '">
               
                <div>
                    <h3><a href="pro_profile_for_user.php?pro=' . $id_presta . '">' . $pro['nomPrefere'] . '</a></h3>
                    <h4>' . $pro['metier']. '</h4>
                    <p>Departement : '. $pro['departement'].'</p>
                    <a id="contact" href="control_pannel.php?page=messages&destinataire='. $email_presta .'">Contacter <img src="images/presta_contact_icon.svg"></a>
                </div>
            </div>' ;
            echo '<img src="images/heart_picto_full.svg" id="fav-'. $id_presta . '"onclick="changePicto(this,'. $id_presta .',' . $_SESSION['id'] .')" class="fav">';
                                    
            echo '</div>' ;
    }
    echo '</section>' ;
    }

//GO FETCH THE FAVORI

    //THE USER' S ID

        $q ='SELECT UTILISATEUR.id FROM UTILISATEUR WHERE personne = ?' ;
        $req = $bdd->prepare($q);
        $req->execute([
            $_SESSION['id']
            ]);
        
        $id_customer = $req->fetchAll(PDO::FETCH_ASSOC);
        
        if ($req) {
            if (count($id_customer) != 1){
                echo 'Il y a eu un problème.';
            } 
        }


    //THE FINAL REQUEST
        $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE 
                INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id 
                    INNER JOIN FAVORI ON PRESTATAIRE.id = FAVORI.prestataire
                        WHERE utilisateur = ?';
        $req = $bdd->prepare($q);
        $req->execute([$id_customer[0]['id']]);

        $results = $req->fetchAll(PDO::FETCH_ASSOC);

        if(count($results) == 0){
            echo '<p>Il n\'y a pas encore de prestataire sur le site.</p>';
        }
?>
<main class="">
    <?php 

        //DISPLAY THE FAVORIS
        displayInfo($results);

    ?>
</main>

        
<script src="../../scripts/favorites.js"></script>