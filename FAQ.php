<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/FAQ.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

        <main>
            <h2>F.A.Q</h2>
            <p>Si vous avez une question, c'est par ici !</p>
            <?php
                $questions = ["Comment contacter un prestataire ?", "Dois-je payer lors de mon inscription ?", "Les prestataires sont-ils fiables ?"];
                $answers = [
                    "Une fois connecté et après avoir cliqué sur le profil d'un prestataire, vous retrouverez l'icone de discussion, cliquez dessus pour ouvrir la page de discussion.",
                    "Non ! L'inscription à PourToujours est gratuite, lorsque vous engagez un prestataire, les paiements se passeront avec lui.",
                    "L'équipe de PourToujours vérifient la fiabilité de chacun des prestataires présents sur le site. De plus, les utilisateurs ont la possibilité de noter les prestataires !"
                ];

                for($i = 0; $i < count($questions); $i++){
                    echo "<section>";
                    echo "<h3>$questions[$i]</h3>";
                    echo "<p>$answers[$i]</p>";
                    echo "</section>";
                }
            ?>

            <div id="under-questions">
                <p>Vous n'avez pas trouvé la réponse à votre question ?</p>
                <a id="contactez-nous" href="mailto:pourtoujours2k22@gmail.com">Contactez-nous !</a>
            </div>
            
        </main>


        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/FAQ.js"></script>
    </body>
</html>
