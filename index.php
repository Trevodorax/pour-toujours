<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/home.css">
    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <main>
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
                <div id="presentation-text">
                    <h2>Présentez-nous vos critères et choisissez parmi nos 230 talentueux partenaires !</h2>
                    <h3>Commencez dès maintenant&nbsp&nbsp <img src="images/go_icon.svg"></h3>
                </div>
                <div id="prestataires-mieux-notes">
                    <div id="prestataires-images">
                        <?php
                            for($i = 1; $i <= 5; $i += 1){
                                echo "<div class='outer-circle'><img src='images/prestataires/prestataire$i.jpg'></div>";
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
                        <p><a href="#">Votre liste d'invités</a></p>
                    </div>
                </div>
                <div class="mobile-hidden">
                    <h3>Choisissez</h3>
                    <div class="action-border">
                        <img src="images/heart_picto.svg">
                        <p><a href="#">Maintenant ou plus tard avec l'option favoris</a></p>
                    </div>
                </div>
                <div>
                    <h3>Discutez</h3>
                    <div class="action-border">
                        <img src="images/bubble_icon.svg">
                        <p><a href="#">Avec vos prestataires</a></p>
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
            <a href="#">Voir plus d'avis...</a>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/home.js"></script>
    </body>

</html>
