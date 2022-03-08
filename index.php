<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- prevents mobile from lying about their viewport cf:https://developer.mozilla.org/en-US/docs/Web/HTML/Viewport_meta_tag -->
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>Pour Toujours</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style/index.css">
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
                <button id="register-button"><p>Inscription gratuite !</p></button>
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
                        <p>Votre budget</p>
                    </div>
                </div>
                <div>
                    <h3>Modifiez</h3>
                    <div class="action-border">
                        <img src="images/invites_icon.svg">
                        <p>Votre liste d'invités</p>
                    </div>
                </div>
                <div class="mobile-hidden">
                    <h3>Choisissez</h3>
                    <div class="action-border">
                        <img src="images/heart_picto.svg">
                        <p>Maintenant ou plus tard avec l'option favoris</p>
                    </div>
                </div>
                <div>
                    <h3>Discutez</h3>
                    <div class="action-border">
                        <img src="images/bubble_icon.svg">
                        <p>Avec vos prestataires</p>
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
    </body>

</html>
