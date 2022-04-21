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
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'hair', false)" for="hair">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'face', false)" for="face">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'eyes', false)" for="eyes">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'nose', false)" for="nose">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'mouth', false)" for="mouth">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'chest', false)" for="chest">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'detail', false)" for="detail">
                        </div>
                        <div id="avatar" class="blue">
                            <div id="hair1" class="hair"></div>
                            <div id="face2" class="face"></div>
                            <div id="eyes2" class="eyes"></div>
                            <div id="nose2" class="nose"></div>
                            <div id="mouth2" class="mouth"></div>
                            <div id="chest1" class="chest"></div>
                            <div id="detail1" class="detail"></div>
                        </div>
                        <div class="avatar-arrows">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'hair', true)" for="hair">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'face', true)" for="face">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'eyes', true)" for="eyes">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'nose', true)" for="nose">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'mouth', true)" for="mouth">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'chest', true)" for="chest">
                            <img src="images/go_icon.svg" onclick="changeAvatar(this, 'detail', true)" for="detail">
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
        <script src="scripts/change_avatar.js"></script>
    </body>
</html>
