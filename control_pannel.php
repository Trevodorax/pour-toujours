<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/control_pannel.css">
    </head>
    <body>
        <?php include('includes/header.php'); ?>

        <main>
            <section id="page-top">
                <h2>Bonjour, Simon !</h2>
                <p>Prêt à continuer l'aventure ?</p>
                <br>
                <div id="launch-QCM">
                    <p>Vous ne savez pas par où démarrer ?  Nous vous avons préparé un QCM justement fait pour ça !</p>
                    <a id="launch-QCM" href="#"><h3>Lancer le QCM<img src="images/go_icon.svg"></h3></a>
                </div>

            </section>

            <section id="mobile-control-nav">
                <p id="nav-opener">Mon panneau de contrôle</p>
                <nav>
                    <br>
                    <a href="#">Vue générale sur mon mariage</a>
                    <a href="#">Mes messages privés</a>
                    <a href="#">Mon lieu de mariage</a>
                    <a href="#">Mon animation</a>
                    <a href="#">Mes photos</a>
                    <a href="#">Mon repas</a>
                    <a href="#">Ma liste d'invités</a>
                    <a href="#">Mes favoris</a>
                    <a href="#">Mes paramètres</a>
                </nav>
            </section>

            <section id="vue-generale">
                <h2>Vue générale sur mon mariage</h2>
                <p>Date : 28/05/22</p>
                <table>
                    <tr>
                        <td>Mon lieu de mariage</td>
                        <td>OK</td>
                    </tr>
                    <tr>
                        <td>Mon animation</td>
                        <td>OK</td>
                    </tr>
                    <tr>
                        <td>Mes photos</td>
                        <td>OK</td>
                    </tr>
                    <tr>
                        <td>Mon repas</td>
                        <td>Non défini</td>
                    </tr>
                    <tr>
                        <td>Ma liste d'invités</td>
                        <td>En cours</td>
                    </tr>
                </table>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>
        <script src="scripts/index.js"></script>
        <script src="scripts/control_pannel.js"></script>
    </body>
</html>