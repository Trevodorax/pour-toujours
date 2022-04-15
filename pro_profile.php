<?php session_start() ;
include('includes/db.php');

if(empty($_SESSION['emailPro'])){     
    header('location: pro_profile_for_user.php');
    exit;
}

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
   
                //Pros view
                $welcome_title = 'Bonjour ';
                $info_det = 'Vos';
                $company_det = "votre";
                $comment_title = 'Avis sur vos prestations';
                    


            echo ' <h2>' . $welcome_title . $_SESSION['nomprefere'] .' ! <a href="#"><img src="images/settings_icon.svg"></a><a href="#"><img src="images/presta_contact_icon.svg"></a></h2>';
            
            $q = 'SELECT id, nomEntreprise, emailPro, telPro,metier, photoProfil, lienSiteWeb FROM prestataire WHERE personne = :personne'; 
            $req = $bdd->prepare($q);            
            $req->execute(['personne' => $_SESSION['id']]);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            $id_presta = $results[0]['id'];
       
            ?>

            <section id="profile">
                <!--  -->
                <div>
                    <?php 
                
                    echo '
                    <h3>' . $info_det .' informations :</h3>
                    <h4>Nom complet : ' . $_SESSION['nomcomplet'] . ' </h4>
                    <p>Métier : ' . $results[0]['metier'] .'</p>
                    <p>Nom de '. $company_det . ' entreprise : ' . $results[0]['nomEntreprise']  .'</p>
                    <p>Email : ' . $_SESSION['emailPro'][0]['emailPro']. '</p>
                    <p>Tel pro : '. $results[0]['telPro'] .'</p>
                    <p>Département : ' . $_SESSION['departement'] . '</p>
                    <p>Lien du site web : <a target="_blank" href="'. $results[0]['lienSiteWeb'] . '">' .$results[0]['lienSiteWeb']. '</a></p>
                    '
                    ?>
                    
                </div>
                <img src="images/prestataires/prestataire1.jpg">
            </section>

            <section id="portfolio">
                <!-- Add and display photos from portfolio -->
                <h3>Votre portfolio</h3>

                <div class="add_photo">
                    <h3>Ajouter une photo au portfolio</h3>
                    <form action="check_services.php" method="POST" enctype="multipart/form-data">
                        <label for="image">Choisissez une image</label>
                        <input type="file" name="image" placeholder=" Votre image (4 Mo max)">
                        <input type="text" name="description" placeholder="description de l'image">

                        <?php 
                            if(isset($_GET['message_photo']) && !empty($_GET['message_photo'])) {

                                echo ' <p id="error-message">'. $_GET['message_photo'] . '</p>';
                            } ?>

                        <input type="submit" class="btn btn-warning ">
                    </form>
                </div>

                <div id="show_portfolio">
                    <!-- Request to show services from the service providers -->
                    <?php 
                        $q ='SELECT id, nom, description FROM PORTFOLIO_IMAGES WHERE prestataire = :id';
                        $req = $bdd->prepare($q);
                        $req -> execute([
                            'id' => $_SESSION['id']
                    ]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    if(count($results) == 0){
                        echo '<p>Vous n\'avez pas encore ajouté d\'images</p>';
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
                <h3>Vos services</h3>
                <div class="add_service">

                    <!-- Not animated yet, just a template so i can make it work -->

                    <h2>Ajouter un service</h2>

                    <form method="POST" action="check_services.php?type=service">

                        <label for='title'>Titre du service</label>
                        <input type="text" name="title" class="required-input" placeholder="ex: Patisseries en quantité (40+)" required>
                        <label for='description'>Description du service(255 caractères)</label>
                        <input type="text" name="description" class="required-input" placeholder="ex: Préparation du jour pour le lendemain des patisseries, choix parmi : choux à la crème, mini-éclairs, madeleines" required>
                        <label for='price'>Tarif du service(par prestation ou par heure (faire un input radio ?))</label>
                        <input type="number" min=0 max=50000 name="price" class="required-input" placeholder="ex: 75" required>

                        <?php 
                            if(isset($_GET['message']) && !empty($_GET['message'])) {

                                echo ' <p id="error-message">'. $_GET['message'] . '</p>';
                            }
                         
                        ?>

                        <button type="submit" name="ajouter">Ajouter</button>
                        <!--  <button type="submit" id="validate-button" class="big-red-button no-click"><p>Ajouter</p></button> -->
                    </form>
                            
                </div>
                <!-- End of template zones -->
                            
                
                <div id="show_services">
                    <!-- Request to show services from the service providers -->
                    <?php 
                        $q ='SELECT id,nom,tarif,description,prestataire FROM SERVICE WHERE prestataire = :id';
                        $req = $bdd->prepare($q);
                        $req -> execute([
                            'id' => $_SESSION['id']
                    ]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    if(count($results) == 0){
                        echo '<p>Vous n\'avez pas encore ajouté de services</p>';
                    }

                    foreach($results as $key => $service){
                        echo '
                        <div class="service-card">
                        <h4>'. $service['nom'].'</h4>
                        <p>Tarif :'. $service['tarif'].'/h</p>
                        <p>Description : '. $service['description'].'</p>
                        <a class="btn btn-sm btn-danger me-2" href="#?id=' . $service['id'] . '">Supprimer</a>
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
            <section id="clients">
                <h3>Vos clients</h3>
                <table>
                    <tr>
                        <th>Nom complet</th>
                        <th>Date du mariage</th>
                        <th>Service</th>
                        <th>Adresse email</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                    <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr>
                </table>
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
                    echo '<p>Vous n\'avez pas encore de commentaire sur vos prestations</p>';
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
                    <!-- TEMPLATE COMMENTS CARDS -->
                    <!-- <div>
                        <p class="comment">Evelynn est d'un professionnel agréable, elle sait donner des directives claires pour un résultat émouvant.</p>
                        <div class="rating">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_black_star.svg">
                            <img src="images/rating_black_star.svg">
                        </div>
                        <p>Alain - 2020</p>
                    </div> -->
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/pro_profile.js"></script>
     
    </body>
</html>
