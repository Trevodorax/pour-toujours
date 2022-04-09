<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/search_presta.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

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
                        $q ='SELECT id, metier, (SELECT nomPrefere, departement FROM PERSONNE) FROM PRESTATAIRE';
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

                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                <div class="presta-card">
                    <img src="images/home_circle.jpg">
                    <div>
                        <h3>Evelynn Delon</h3>
                        <h4>Photographe</h4>
                        <p>Orléans</p>
                        <a>Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/search_presta.js"></script>
    </body>
</html>
