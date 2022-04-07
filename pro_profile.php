<?php session_start() ;
include('includes/db.php');
?>

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
                    function show_page($statut, $id){
                        
                    }

                    //Utiliser pour faire la différence d'affichage : vu presta et vu client
                    if (empty($_SESSION['emailPro'])){
                        //Customers view
                        $welcome_title = 'Le profil de ';
                        $info_det = 'Ses';
                        $company_det = "son";
                        $comment_title = 'Avis sur ce prestataire';

                    } else {
                        //Pros view
                        $welcome_title = 'Bonjour ';
                        $info_det = 'Vos';
                        $company_det = "votre";
                        $comment_title = 'Avis sur vos prestations';
                    }


            echo ' <h2>' . $welcome_title . $_SESSION['nomprefere'] .' ! <a href="#"><img src="images/settings_icon.svg"></a><a href="#"><img src="images/presta_contact_icon.svg"></a></h2>';
            
            $q = 'SELECT nomEntreprise, emailPro, telPro,metier, photoProfil, lienSiteWeb FROM prestataire WHERE personne = :id'; 
            $req = $bdd->prepare($q);            
            $req->execute(['id' => $_SESSION['id']]);
            $results = $req->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <section id="profile">
                <div>
                    <?php 
                
                    echo '
                    <h3>' . $info_det .' informations :</h3>
                    <h4>Nom complet : ' . $_SESSION['nomcomplet'] . ' </h4>
                    <p>Métier : ' . $results[0]['metier'] .'</p>
                    <p>Nom de '. $company_det . ' entreprise : ' . $results[0]['nomEntreprise']  .'</p>
                    <p>Email : ' . $_SESSION['emailPro'][0]['emailPro']. '</p>
                    <p>Tel pro : '. $results[0]['telPro'] .'</p>
                    <p>Secteur : ' . $_SESSION['departement'] . '</p>
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
