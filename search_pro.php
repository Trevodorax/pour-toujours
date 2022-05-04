<?php session_start() ;

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

?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/search_presta.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>
        <?php include('includes/db.php'); ?>

        <main>
            <div id="desktop-page-top">
                <div id="page-title">
                    <h2>Nos prestataires</h2>
                    <p>Découvrez tous nos prestataires prêts à travailler à vos côtés pour un mariage réussi !</p>
                </div>
                
                <div id="page-top">
                    <p id="sort-button">Triez par <img src="images/three_dots.svg"></p>
                    <div id="sort" class="pouf">
                        <a id="time1" onclick="sort(this)">Ancienneté (+ à -)</a>  
                        <a id="time2" onclick="sort(this)">Ancienneté (- à +)</a>
                        <a id="alphabet" onclick="sort(this)">Ordre alphabétique (A à Z)</a>
                    </div>
                </div>
            </div>
            <section id="page-bottom">
                
                <section id="filter-area">

                    <h2>Filtrez les résultats</h2>

                    <div class="type list">
                        <h3>Services</h3>
                        <!-- The only services we have at the moment -->
                        <p onclick="filter(this)">Photographie</p>
                        <p onclick="filter(this)">Animation</p>
                        <p onclick="filter(this)">Nourriture</p>
                        <p onclick="filter(this)">Lieu</p>
                        <p onclick="filter(this)">Tenue</p>
                    </div>

                    <div class="departement list">
                        <h3>Département prisé</h3>
                        <!-- Declared by us -->
                        <p onclick="filter(this)">75 - Paris</p>
                        <p onclick="filter(this)">13 - Bouches du Rhones</p>
                        <p onclick="filter(this)">35 - Ile-et-Villaine</p>
                    </div>
                    <div class="rank">
                    <h3 id="best-pro" onclick="filter(this)">Les plus recommendés (3)</h3>
                    </div>
                  
                    <a id="remove-filter" href="search_pro.php" class="btn-danger btn">Retirer les filtres</a>

                </section>

                <section id="all-presta">

                    <?php

                         //Display the cards about the service providers
                         function displayInfo($informations){
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
    
                                    if ( isCustomer() && isLogged()){
                                        echo '<img id="fav-'. $id_presta . '"onclick="addToFav(this,'. $id_presta .',' . $_SESSION['id'] .')" class="favorites" src="images/heart_picto.svg">';
                                    }
                                    echo '</div>' ;
                                }
                            }
                        
                        //These are needed to filter results (needed this part for the control panel-grid)

                        if(isset($_GET['type'])){

                                //Request with filters if they exist
                                $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id WHERE metier = ?';
                                $req = $bdd->prepare($q);
                                $req->execute([
                                    $_POST['content']
                                ]);
                                $results = $req->fetchAll(PDO::FETCH_ASSOC);

                                if(count($results) == 0){
                    
                                    echo '<p>Il n\'y a pas de prestataires correspondant à ce filtre.</p>';
                                }

                                displayInfo($results);

                        } else {

                            //Request Without filters so ALL the service providers
                            $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id ORDER BY nomEntreprise';
                            $req = $bdd->query($q);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC);

                            if(count($results) == 0){
                                echo '<p>Il n\'y a pas encore de prestataire sur le site.</p>';
                            }
                            displayInfo($results);
                        }
                        
                    
                        ?>
                </section>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/favorites.js"></script>
        <script src="scripts/search_presta.js"></script>
    </body>
</html>
