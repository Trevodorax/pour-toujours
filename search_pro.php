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
                        <a id="time" onclick="sort(this)">Date d'inscription</a>  
                        <a id="metier" onclick="sort(this)">Métiers</a>
                        <a id="alphabet" onclick="sort(this)">Ordre alphabétique du nom</a>
                    </div>
                </div>
            </div>
            <section id="page-bottom">
                <section id="filter-area">

                    <h2>Filtrez les résultats</h2>

                    <div class="metier list">
                        <h3>Activité </h3>
                        <p onclick="filter(this)">Photographie</p>
                        <p onclick="filter(this)">Décoration</p>
                        <p onclick="filter(this)">Cuisine</p>
                        <p onclick="filter(this)">Fleuriste</p>
                    </div>

                    <div class="departement list">
                        <h3>Département prisé</h3>
                        <p onclick="filter(this)">75 - Paris</p>
                        <p onclick="filter(this)">13 - Bouches du Rhones</p>
                        <p onclick="filter(this)">35 - Ile-et-Villaine</p>
                    </div>
                    <h3 id="best-pro" onclick="filter(this)">Les plus recommendés (3)</h3>

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
                        
                        //These are needed to filter results (needed this part for the control panel-grid)

                        if(isset($_GET['type'])){

                                //Request with filters if they exist
                                $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id WHERE metier = ? ORDER BY nomEntreprise';
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
        <script src="scripts/search_presta.js"></script>
    </body>
</html>
