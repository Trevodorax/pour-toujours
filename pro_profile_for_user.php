<?php session_start() ;
include('includes/db.php');


function isLogged(){
    if( isset($_SESSION['email'])) {
        return true;
    }
}

// The user comes from a page where he clicked on the name of a pro, for exemple.
// We need to get something from this page to be able to 
// display the informations about the correct pro.
?>


<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/pro_profile.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

        <main>
            <?php 
                //Customers view
                    $welcome_title = 'Le profil de ';
                    $info_det = 'Ses';
                    $company_det = "son";
                    $comment_title = 'Avis sur ce prestataire';
                    $id_presta = htmlspecialchars($_GET['pro']);
                    
                //REQUEST TO DISPLAY PRO INFORMATIONS :

                    if (isset($id_presta)){

                        $q = 'SELECT nomPrefere, email, departement, nomEntreprise, emailPro, telPro, metier, photoProfil, lienSiteWeb FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id WHERE PRESTATAIRE.id = :id'; 
                        $req = $bdd->prepare($q);            
                        $req->execute(['id' => $id_presta]);
                        $results = $req->fetchAll(PDO::FETCH_ASSOC);
                       
                    } else {
                        header('location:search_pro.php?message=Il y a eu une erreur, veuillez réessayer');
                        exit;
                    }              
       
            ?>

            <section id="profile">
                <!--  -->
                <div>
                    <?php 
                         if (isLogged()){
                            echo ' <h2>' . $welcome_title . $results[0]['nomPrefere'] .' !<a href="control_pannel.php?page=messages&destinataire='. $results[0]['email'] . '"><img src="images/presta_contact_icon.svg"></a></h2>';
                         } else {
                             echo ' <h2>' . $welcome_title . $results[0]['nomPrefere'] .' !</h2>';
                         }

                    echo '
                            <h3>' . $info_det .' informations :</h3>
                            <p>Métier : ' . $results[0]['metier'] .'</p>
                            <p>Nom de '. $company_det . ' entreprise : ' . $results[0]['nomEntreprise']  .'</p>';

                        if (isLogged()){
                            echo '<p>Email : ' . $results[0]['emailPro'] . '</p>
                            <p>Tel pro : '. $results[0]['telPro'] .'</p>';
                        } else {
                            echo '<p id="message">Vous devez être connecté pour voir les coordonnées de ce prestataire</p>';
                        }
                    
                    echo '<p>Département: ' . $results[0]['departement'] . '</p>
                    <p>Lien du site web : <a target="_blank" href="'. $results[0]['lienSiteWeb'] . '">' .$results[0]['lienSiteWeb']. '</a></p>
                    ';
                    ?>
                    
                </div>
                <?= '<img src="images/prestataires/' . $results[0]['photoProfil']. '">' ;?>
            </section>

            <section id="portfolio">
               
                <h3>Le portfolio de ce prestataire</h3>
                
                <div id="show_portfolio">
                    <!-- Request to show services from the service providers -->
                    <?php 
                        $q ='SELECT id, nom, description FROM PORTFOLIO_IMAGES WHERE prestataire = :id';
                        $req = $bdd->prepare($q);
                        $req -> execute([
                            'id' => $id_presta
                    ]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    if(count($results) == 0){
                        echo '<p>Le prestataire n\'as pas encore ajouté d\'images</p>';
                    }

                    foreach($results as $key => $image){
                        echo '<div class="portfolio-card">';
                        echo ' <img src="' .$image['nom'] .'" alt="' . $image['description'] . '" border=1>';
                        echo '</div> ';
                    }        
                    ?>
              
            </section>

            <section id="services">
                <h3>Ses offres de services</h3>
       
                <div id="show_services">
                    <!-- Request to show services from the service providers -->
                    <?php 
                        $q ='SELECT id,nom,tarif,description,prestataire FROM SERVICE WHERE prestataire = :id';
                        $req = $bdd->prepare($q);
                        $req -> execute([
                            'id' => $id_presta
                    ]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    if(count($results) == 0){
                        echo '<p>Ce prestataire n\'as pas encore ajouté de services</p>';
                    }

                    foreach($results as $key => $service){
                        echo '
                        <div class="service-card">
                        <h4>'. $service['nom'].'</h4>
                        <p>Tarif :'. $service['tarif'].'/h</p>
                        <p>Description : '. $service['description'].'</p>
                        </div>
                        ';
                    }        
                    ?>

                 </div>
            </section>

            <h3>Avis sur ce prestataire</h3>
            
            <section id="reviews">

            <?php 
                $q = 'SELECT (SELECT nomPrefere FROM PERSONNE WHERE id = utilisateur) AS nom_client, note, contenu, date_envoi FROM COMMENTAIRE WHERE prestataire = :prestataire' ;
                $req = $bdd->prepare($q);
                $req -> execute([
                    'prestataire' => $id_presta
                ]);
                $result = $req -> fetchAll(PDO::FETCH_ASSOC);
                if(count($result) == 0){
                    echo '<p>Ce prestataire n\'as pas encore de commentaire sur ses prestatations</p>';
                }
                    foreach($result as $key => $commentaire){
                        echo '
                            <div>
                            <p class="comment">'. $commentaire['contenu']. '</p>
                            <div class="rating">';
                                for($i = 0; $i<$commentaire['note']; $i++){
                                echo '<img src="images/rating_red_star.svg">';
                                }
                            
                        echo '</div>
                            <p>'. $commentaire['nom_client']. ' - ' . $commentaire['date_envoi'] . '</p>
                        </div>';
                    }
            ?> 
                    <!-- Adding a comment will be available at the end of the wedding on a "let us comments on ur experience" page -->
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/pro_profile.js"></script>
     
    </body>
</html>
