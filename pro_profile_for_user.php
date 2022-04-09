<?php session_start() ;
include('includes/db.php');

$loggedIn = false;
if(isset($_SESSION['email'])){
    $loggedIn = true    ;
}
// The user comes from a page where he clicked on the name of a pro, for exemple. We need to get something from this page to be able to 
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

                //REQUEST TO DISPLAY PRO INFORMATIONS :

                    $q = 'SELECT id, nomEntreprise, emailPro, telPro, metier, photoProfil, lienSiteWeb FROM prestataire WHERE personne = :personne'; 
                    $req = $bdd->prepare($q);            
                    $req->execute(['personne' => $value]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    $id_presta = $results[0]['id'];
       
            ?>

            <section id="profile">
                <!--  -->
                <div>
                    <?php 
                    echo ' <h2>' . $welcome_title . $_SESSION['nomprefere'] .' ! <a href="#"><img src="images/settings_icon.svg"></a><a href="#"><img src="images/presta_contact_icon.svg"></a></h2>';
            
                    echo '
                    <h3>' . $info_det .' informations :</h3>
                    <p>Métier : ' . $results[0]['metier'] .'</p>
                    <p>Nom de '. $company_det . ' entreprise : ' . $results[0]['nomEntreprise']  .'</p>
                    <p>Email : ' . $results[0]['emailPro'] . '</p>
                    <p>Tel pro : '. $results[0]['telPro'] .'</p>
                    <p>Secteur : ' . $_SESSION['departement'] . '</p>
                    '
                    ?>
                    
                </div>
                <?= '<img src="' . $results[0]['photoProfil']. '">' ;?>
            </section>

            <section id="portfolio">

                <!-- Only if it exist -->
               
                <h3>Le portfolio de </h3>
                
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
                        echo '<div class="service-card">';
                        echo ' <img src="' .$image['nom'] .'" alt="' . $image['description'] . '" border=1>';
                        echo '<a class="btn btn-sm btn-danger me-2" href="#?id=' . $image['id'] . '">Supprimer</a>
                        </div> ';
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
                        <a class="btn btn-sm btn-danger me-2" href="#?id=' . $service['id'] . '">Commander</a>
                        </div>
                        ';
                    }        
                    ?>

                    <!-- Templates des services_card -->

                    <!-- <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div> -->
                 </div>
            </section>

            <h3>Avis sur ce prestataire</h3>
            
            <section id="reviews">

            <?php 
                $q = 'SELECT (SELECT nomPrefere FROM personne WHERE id = utilisateur) AS nom_client, note, contenu, date_envoi FROM COMMENTAIRE WHERE prestataire = :prestataire' ;
                $req = $bdd->prepare($q);
                $req -> execute([
                    'prestataire' => $id_presta
                ]);
                $result = $req -> fetchAll(PDO::FETCH_ASSOC);
                if(count($result) == 0){
                    echo '<p>Vous n\'avez pas encore de commentaire sur vos</p>';
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
