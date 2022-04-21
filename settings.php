<?php session_start() ?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/avatar.css">
        <link rel="stylesheet" href="style/settings.css">
    </head>
    <body>

        <?php include('includes/header.php'); ?>

        <main>

            <h2>Mes paramètres</h2>
            <section id="settings-generaux">
                <h3>Généraux</h3>
                <p>Affichage sombre</p>
                <p>Affichage sombre</p>
                <p>Affichage sombre</p>
            </section>

            <section id="settings-confidentialite">
                <h3>Confidentialité</h3>
                <p>Mentions légales</p>
                <p>Contactez l'équipe technique</p>
                <p>Lier une nouvelle adresse e-mail à mon compte</p>
            </section>

            <section id="settings-profil">
                <h3>Mon profil</h3>
                <div>
                    <p>Personnaliser mon avatar</p>
                    <div id="avatar-maker">
                        <div class="avatar-arrows">
                            <img src="images/go_icon.svg" onclick="changeAvatar('hair', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('face', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('eyes', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('nose', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('mouth', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('chest', false)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('detail', false)">
                        </div>
                        <div id="avatar" class="blue">
                            <div id="hair1"></div>
                            <div id="face2"></div>
                            <div id="eyes2"></div>
                            <div id="nose2"></div>
                            <div id="mouth2"></div>
                            <div id="chest1"></div>
                            <div id="detail1"></div>
                        </div>
                        <div class="avatar-arrows">
                            <img src="images/go_icon.svg" onclick="changeAvatar('hair', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('face', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('eyes', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('nose', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('mouth', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('chest', true)">
                            <img src="images/go_icon.svg" onclick="changeAvatar('detail', true)">
                        </div>
                    </div>
                    <p>Modifier mon mot de passe</p>
                    <p>Supprimer mon compte</p>
                    <p>Lier une nouvelle adresse e-mail à mon compte</p>
                </div>
            </section>

        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/settings.js"></script>
    </body>
</html>
