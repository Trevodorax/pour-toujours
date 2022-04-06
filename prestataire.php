<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/prestataire.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

        <main>
            <?php 
            echo ' <h2>Bonjour ' . $_SESSION['nomPrefere'] .' ! <a href="#"><img src="images/settings_icon.svg"></a><a href="#"><img src="images/presta_contact_icon.svg"></a></h2>';
            
            $q = 'SELECT nomEntreprise, emailPro, telPro,metier, photoProfil, lienSiteWeb FROM user WHERE id = :id'; 
            $req = $bdd->prepare($q);            
            $req->execute(['id' => $_SESSION['id']]);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <section id="profile">
                <div>
                    <?php 
                    //Let's finish later
                    echo '
                    <h3>Vos informations :</h3>
                    <h4>Nom complet : ' . $_SESSION['nomComplet'] . ' </h4>
                    <p>Métier : ' . $results[0]['metier'] .'</p>
                    <p>Nom de votre entreprise : ' . $results[0]['nomEEntreprise']  .'</p>
                    <p>Email : evelynn.pro@gmail.com</p>
                    <p>Tel pro : '. $results[0]['metier'] .'</p>
                    <p>Secteur : Orléans</p>
                    '
                    ?>
                    
                </div>
                <img src="images/prestataires/prestataire1.jpg">
            </section>
            <section id="services">
                <h3>Vos services</h3>
                <div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="service-card">
                        <h4>Photos mariage</h4>
                        <p>Tarif : 20€/h</p>
                        <p>Description : Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
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
                    <div>
                        <p class="comment">Evelynn est d'un professionnel agréable, elle sait donner des directives claires pour un résultat émouvant.</p>
                        <div class="rating">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_black_star.svg">
                            <img src="images/rating_black_star.svg">
                        </div>
                        <p>Alain - 2020</p>
                    </div>
                    <div>
                        <p class="comment">Evelynn est d'un professionnel agréable, elle sait donner des directives claires pour un résultat émouvant.</p>
                        <div class="rating">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_black_star.svg">
                            <img src="images/rating_black_star.svg">
                        </div>
                        <p>Alain - 2020</p>
                    </div>
                    <div>
                        <p class="comment">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui cumque fugiat impedit natus? Blanditiis, fuga non? Totam exercitationem nulla, laborum dolores aperiam, ipsa ullam in repellat sequi nam quos culpa.</p>
                        <div class="rating">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_red_star.svg">
                            <img src="images/rating_black_star.svg">
                            <img src="images/rating_black_star.svg">
                        </div>
                        <p>Alain - 2020</p>
                    </div>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/prestataire.js"></script>
    </body>
</html>
