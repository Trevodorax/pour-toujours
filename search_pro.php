<?php session_start() ?>

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
                    <p>Découvrez tous nos prestataires prêts à travailler à vos côtés pour un mariage réussi</p>
                </div>
                <div id="page-top">
                    <p id="filters-button">Filtrez <img src="images/filter.svg"></p>
                    <p>Triez par <img src="images/three_dots.svg"></p>
                    <div id="filters">
                        <a>Les mieux notés</a>
                        <a>Ordre alphabétique</a>
                    </div>
                </div>
            </div>

            <section>

                 <?php 
                        $q ='SELECT PRESTATAIRE.id, metier,photoProfil, nomPrefere, email, departement FROM PRESTATAIRE INNER JOIN PERSONNE ON PRESTATAIRE.personne = PERSONNE.id ORDER BY nomEntreprise';
                        $req = $bdd->query($q);
                        $results = $req->fetchAll(PDO::FETCH_ASSOC);

                        if(count($results) == 0){
                            echo '<p>Il n\'a pas encore de prestataire sur le site.</p>';
                        }
                        
                    foreach($results as $key => $pro){
                        $id_presta = $pro['id'] ;
                        $email_presta = $pro['email'];
                        $path = 'images/pp_presta';
                        echo '
                            <div class="presta-card">
                                <img src="'. $path . '/' . $pro['photoProfil'] . '">
                                <div>
                                    <h3>' . $pro['nomPrefere'] . '</h3>
                                    <h4>' . $pro['metier']. '</h4>
                                    <p>Departement : '. $pro['departement'].'</p>
                                    <a href="control_pannel.php?page=messages&destinataire='. $email_presta .'">Contacter <img src="images/presta_contact_icon.svg"></a>
                                </div>
                            </div>
                        ' ;}
                    ?>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/search_presta.js"></script>
    </body>
</html>
