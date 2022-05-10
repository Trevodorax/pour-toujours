<?php session_start();?>


<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/home.css">
    </head>

    <body>
    <?php include('includes/header.php'); 
    include('includes/db.php'); ?>
    <main>
        <?php
        if (isset($_GET['message'])){
            $message = htmlspecialchars($_GET['message']);
            echo '<p style="color: #CF6987;">' . $message . '</p>';
        }
        ?>
        <section id="call-to-action">
            <div id="home-circle" class="outer-circle"><div></div></div>
            <div id="home-text">
                <h2>En quête du mariage parfait ?</h2>
                <div>
                    <p>Pour Toujours vous propose ses services</p>
                    <img src="images/gift_icon.svg">
                </div>
                <div>
                    <p>En quelques clics, retrouvez tous les services dont vous avez besoin pour le jour J</p>
                    <img src="images/cursor_icon.svg">
                </div>
                <button class="big-red-button" onclick="location.href='create_account.php'"><p>Inscription gratuite !</p></button>
            </div>
        </section>
        <section id="presentation">
            <div id="presentation-banner">

                <?php 
                $q='SELECT COUNT(PRESTATAIRE.id) AS pros FROM PRESTATAIRE';
                $req= $bdd->query($q);
                $result = $req->fetchAll(PDO::FETCH_ASSOC);
                ?>


                <div id="presentation-text">
                    <h2>Présentez-nous vos critères et choisissez parmi nos <?= $result[0]['pros'] ?> talentueux partenaires !</h2>
                    <a href="create_account.php"><h3>Commencez dès maintenant&nbsp&nbsp <img src="images/go_icon.svg"></h3></a>
                </div>
                <div id="prestataires-mieux-notes">
                    <div id="prestataires-images">
                        <?php
                            include('includes/db.php');
                            $q = 'SELECT presta.id, presta.photoProfil
                            FROM PRESTATAIRE AS presta
                            INNER JOIN
                                 (SELECT prestataire
                                 FROM COMMENTAIRE
                                 GROUP BY prestataire
                                 ORDER BY AVG(note) DESC
                                 LIMIT 5) as comm
                            ON presta.id = comm.prestataire';

                            $req = $bdd->prepare($q);
                            $req->execute([]);
                            $results = $req->fetchAll(PDO::FETCH_ASSOC);


                            foreach($results as $prestataire){
                                echo "<a href='pro_profile_for_user.php?pro=" . $prestataire['id'] . "' class='outer-circle'><img src='images/prestataires/" . $prestataire['photoProfil'] . "'></a>";
                            }
                        ?>
                    </div>
                    <h3>Prestataires les mieux notés</h3>
                </div>
            </div>
            <div id="actions-possibles">
                <div>
                    <h3>Gérez</h3>
                    <div class="action-border">
                        <img src="images/cart_icon.svg">
                        <p><a href="#">Votre budget</a></p>
                    </div>
                </div>
                <div>
                    <h3>Modifiez</h3>
                    <div class="action-border">
                        <img src="images/invites_icon.svg">
                        <p><a href="">Votre liste d'invités</a></p>
                    </div>
                </div>
                <div class="mobile-hidden">
                    <h3>Choisissez</h3>
                    <div class="action-border">
                        <img src="images/heart_picto.svg">
                        <p><a href="">Maintenant ou plus tard avec l'option favoris</a></p>
                    </div>
                </div>
                <div>
                    <h3>Discutez</h3>
                    <div class="action-border">
                        <img src="images/bubble_icon.svg">
                        <p><a href="">Avec vos prestataires</a></p>
                    </div>
                </div>

            </div>
        </section>
        <section id="reviews">
            <h2>Découvrez les avis de la communauté !</h2>
            <h3 class="mobile-hidden">Et leur expérience avec le site et ses partenaires</h3>
            <div id="reviews-carousel">
                <div id="carousel-image"></div>
                <div id="carousel-text">
                    <p>"Trop cool, j'espère ne pas avoir à leur redemander de l'aide, mais si besoin je le ferai !"</p>
                    <p>Paul & Simon - 9/02/2022</p>
                </div>
            </div>
            <a href="images/easter_egg_du_dimanche.jpg">Voir plus d'avis...</a>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/home.js"></script>
    </body>

</html>
