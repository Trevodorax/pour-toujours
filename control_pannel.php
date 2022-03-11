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
                <p>Vous ne savez pas par où démarrer ?  Nous vous avons préparé un QCM justement fait pour ça !</p>
                <a id="launch-QCM" href="#"><h3>Lancer le QCM<img src="images/go_icon.svg"></h3></a>
            </section>

            <section id="control-nav">
                <p id="nav-opener">Mon panneau de contrôle</p>
            </section>
            
        </main>

        <?php include('includes/footer.php'); ?>
        <script src="scripts/index.js"></script>
        <script src="scripts/control_pannel.js"></script>
    </body>
</html>