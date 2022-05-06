<?php session_start() ;
include('includes/db.php');



function isCustomer(){
    if(empty($_SESSION['emailPro'])){
        return true;
    }
}

if(isCustomer()){     
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
                    


                echo ' <h2>' . $welcome_title . $_SESSION['nomPrefere'] .' ! <a href="settings.php"><img src="images/settings_icon.svg"></a><a href="control_pannel.php?page=messages"><img src="images/presta_contact_icon.svg"></a></h2>';
                
                $q = 'SELECT id, nomEntreprise, emailPro, telPro,metier, photoProfil, lienSiteWeb FROM PRESTATAIRE WHERE personne = :personne'; 
                $req = $bdd->prepare($q);            
                $req->execute(['personne' => $_SESSION['id']]);
                $results = $req->fetchAll(PDO::FETCH_ASSOC);
                $id_presta = $results[0]['id'];
                $type = $results[0]['metier'];
       
            ?>

            <section id="profile">
                <!-- All informations about the service provider 
                     We take some from the session directly and we go fetch the others -->
                <div>
                    <?php 
                    echo '
                    <h3>' . $info_det .' informations :</h3>
                    <h4>Nom complet : ' . $_SESSION['nomComplet'] . ' </h4>
                    <p>Métier : ' . $results[0]['metier'] .'</p>
                    <p>Nom de '. $company_det . ' entreprise : ' . $results[0]['nomEntreprise']  .'</p>
                    <p>Email : ' . $results[0]['emailPro']. '</p>
                    <p>Tel pro : '. $results[0]['telPro'] .'</p>
                    <p>Département : ' . $_SESSION['departement'] . '</p>
                    <p>Lien du site web : <a target="_blank" href="'. $results[0]['lienSiteWeb'] . '">' .$results[0]['lienSiteWeb']. '</a></p>
                    ';
                    echo '</div>'; ?>

                    <?php echo '<img src="images/prestataires/'. $results[0]['photoProfil'] . '">'
                    ?>
                    
                    <section id="signature">
                        <div class="row">
                            <h3>Votre signature</h3>
                            <p>Veuillez signer ci-dessous pour enregistrer votre signature, nous validerons votre profil après cela.</p>
                            <canvas id="sign-space" class="mb-3" width="300px" height="100px"></canvas>
                            
                            <button class="btn btn-primary mb-2" id="sig-submitBtn" onclick="saveAsImage()">Envoyer la signature</button>
			            	<button class="btn btn-danger" id="sig-clearBtn" onclick="eraseCanva()">Effacer la signature</button>
                        </div>
                    </section>    
            </section>

            <section id="portfolio">
                <!-- Add and display photos from portfolio of the service provider -->
                <h3>Votre portfolio</h3>

                <div class="add">
                    <p class="title">Ajouter une photo au portfolio</p>
                    <form class="portfolio" action="check_services.php?pro=<?= $id_presta ?>" method="POST" enctype="multipart/form-data">
                        <label for="image">Choisissez une image</label>
                        <input type="file" name="image"  required placeholder=" Votre image (4 Mo max)">
                        <input type="text" name="description" required  placeholder="description de l'image">

                        <?php 
                            if(isset($_GET['message_photo']) && !empty($_GET['message_photo'])) {

                                echo '<p id="error-message">'. $_GET['message_photo'] . '</p>';
                            } 

                            ?>

                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>

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
                        echo '<p>Vous n\'avez pas encore ajouté d\'images</p>';
                    }

                    foreach($results as $key => $image){
                        echo '<div class="portfolio-card">';
                        echo ' <img src="' . $image['nom'] .'" alt="' . $image['description'] . '" border=1>';
                        echo '<a class="btn btn-sm btn-danger" onclick="deleteInfos(this, \'portfolio_images\',' . $image['id'] . ',' .$id_presta . ')">Supprimer</a>
                        </div> ';
                    }        
                    ?>
              
            </section>

            <section id="services">
                <h3>Vos services</h3>
                <div class="add">

                    <p class="title">Ajouter un service</p>

                    <form class="service" method="POST" action="check_services.php?section=service&pro=<?= $id_presta ?>">

                        <label for="type">Catégorie du service</label>
                        <select id="Scategory" name="type">
                            <?php
                                echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner une catégorie ---</option>";
                                $type_options = ["Nourriture","Animation", "Lieu", "Tenue", "Photographie"];
                                foreach ($type_options as $Stype){
                                    echo "<option value='$Stype'>$Stype</option>";
                                }
                            ?>
                        </select>
                        <label for='title'>Titre du service</label>
                        <input type="text" name="title" class="required-input" placeholder="ex: Patisseries en quantité (40+)" required>
                        <label for='description'>Description du service(255 caractères)</label>
                        <input type="text" name="description" class="required-input" required placeholder="ex: Préparation du jour pour le lendemain des patisseries, choix parmi : choux à la crème, mini-éclairs, madeleines" required>
                        <label for='price'>Tarif du service (en €)</label>
                        <input type="number" min=0 max=50000 name="price" class="required-input" placeholder="ex: 75" required>

                        <?php 
                            if(isset($_GET['message']) && !empty($_GET['message'])) {

                                echo ' <p id="error-message">'. $_GET['message'] . '</p>';
                            }
                         
                        ?>

                        <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
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
                            'id' => $id_presta
       
                    ]);
                    $results = $req->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                    if(count($results) == 0){
                        echo '<p>Vous n\'avez pas encore ajouté de services</p>';
                    }

                    foreach($results as $key => $service){
                        echo '
                        <div class="service-card">
                        <h4>'. $service['nom'].'</h4>
                        <p>Tarif :'. $service['tarif'].' € par prestatation </p>
                        <p>Description : '. $service['description'].'</p>
                        <a class="btn btn-sm btn-danger me-2" onclick="deleteInfos(this, \'service\',' . $service['id'] . ',' .$id_presta . ')">Supprimer</a>
                        </div>
                        ';
                    }        
                    ?>
                   
                </div>
            </section>
            <section id="clients">
                <h3>Vos clients</h3>

                <?php 
                        //VERY LONG REQUEST BUT we need it
                    $q ='SELECT PERSONNE.NomComplet, PERSONNE.email, MARIAGE.date , DEMANDE.service FROM PERSONNE 
                            INNER JOIN UTILISATEUR ON personne = PERSONNE.id
                                INNER JOIN MARIAGE ON utilisateur = UTILISATEUR.id 
                                    INNER JOIN DEMANDE ON DEMANDE.mariage = MARIAGE.id 
                                        INNER JOIN SERVICE ON SERVICE.id = DEMANDE.service
                                            WHERE SERVICE.prestataire = :id';
                    $req = $bdd->prepare($q);
                    $req -> execute([
                         'id' => $id_presta                              
                            ]);
                 $results = $req->fetchAll(PDO::FETCH_ASSOC);

                 if(count($results) == 0){
                     echo '<p>Vous n\'avez pas encore de clients</p>';
                 }

                 //Basic structure of the table
                 echo '
                        <table>
                        <tr>
                            <th>Nom complet</th>
                            <th>Date du mariage</th>
                            <th>Service</th>
                            <th>Adresse email</th>
                            <th></th>
                        </tr>';

                //Displaying infos on the customer who ordered a service       
                foreach($results as $key =>$customer)  {      
                    echo '<tr>';
                    echo '<td>' . $customer['NomComplet'] . '</td>';
                    echo '<td>' . $customer['date'] . '</td>';
                    echo '<td>' . $customer['service'] . '</td>';
                    echo '<td>' . $customer['email'] . '</td>';
                    echo '<td><img src="images/presta_contact_icon.svg"></td>';
                    echo '</tr>';
                }   
                echo '</table>';
                
                ?>  
                    <!-- Template for the table row  -->
                    <!-- <tr>
                        <td>Fredo Sananos</td>
                        <td>2/09/22</td>
                        <td>2</td>
                        <td>f.sananes@gmail.com</td>
                        <td><img src="images/presta_contact_icon.svg"></td>
                    </tr> -->

              
            </section>

            <h3>Avis sur vos prestations</h3>
            
            <section id="reviews">

            <?php 
                $q = 'SELECT (SELECT nomPrefere FROM PERSONNE WHERE id = utilisateur) AS nom_client, note, contenu, date_envoi FROM COMMENTAIRE WHERE prestataire = :prestataire' ;
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
        <script src="scripts/draw_signature.js"></script>
     
    </body>
</html>
