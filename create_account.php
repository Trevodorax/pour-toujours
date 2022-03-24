<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/create_account.css">
    </head>
    <body>
        <?php include('includes/header.php'); ?>

        <main>
            <a href="#">Accès pro</a>
            <a href="#">Accès utilisateur</a>
            <h2>Créer un compte<span class="user-form" onclick="switch_forms()" id="top-right-acces-pro">Accès pro</span><span class="pro-form" onclick="switch_forms()" id="top-right-acces-pro"r>Accès utilisateur</span></h2>
            <p>Saisissez vos informations pour continuer</p>
            <p class="pro-form">Vous pourrez présenter vos services en détail dans votre profil après vous être créer un compte.</p>
            <form>
                <input type="text" name="f_name" class="required-input" placeholder=" Votre prénom">

                <input type="text" name="l_name" class="required-input" placeholder=" Votre nom">

                <input class="pro-form" type="text" name="company_name" placeholder=" Nom de votre entreprise">

                <select id="region" name="region">
                    <?php
                        $dropdown_options = ["Auvergne-Rhône-Alpes", "Bourgogne-Franche-Comté", "Bretagne", "Centre-Val de Loire", "Corse", "Grand Est", "Hauts-de-France", "Ile-de-France"];
                        foreach ($dropdown_options as $region){
                            echo "<option value='$region'>$region</option>";
                        }
                    ?>
                </select>

                <input type="tel" name="tel" placeholder=" Votre numéro de téléphone">

                <input type="email" name="email" class="required-input" placeholder=" Votre e-mail">

                <input class="pro-form " type="email" name="email" placeholder=" Votre e-mail professionnel">

                <input type="password" name="password" class="required-input" placeholder=" Votre mot de passe">


                <select class="user-form" id="genre">
                    <option value="man">Homme</option>
                    <option value="woman">Femme</option>
                    <option value="no_answer">Préfère ne pas répondre</option>
                    <option value="other">Autre</option>
                </select>

                <select class="pro-form " id="secteur-activite">
                    <?php
                        $secteurs_activite = ["Photographie", "Cuisine", "Décoration de salles", "Fleuriste"];
                        foreach ($secteurs_activite as $activite){
                            echo "<option value='$activite'>$activite</option>";
                        }
                    ?>
                </select>

                <div class="checkbox-line">
                    <input class="must-check" type="checkbox" name="certified_adult">
                    <span>J'accepte la politique de confidentialité du site. Je certifie avoir 18 ans révolus.</span>
                </div>

                <div class="checkbox-line">
                    <input type="checkbox" name="email_list">
                    <span>Si vous souhaitez recevoir des notifications par mail, veuillez cocher la case ci-contre.</span>
                </div>

                <p id="champs-obligatoires">Les champs marqués d'une * sont obligatoires.</p>
            </form>
            <button id="validate-button" class="big-red-button no-click"><p>Créer mon compte</p></button>
            <div id="under-form">
                <p>Vous avez déjà un compte ? <a href="#">Se connecter</a></p>
                <p class="user-form" onclick="switch_forms()">Vous souhaitez proposer vos services ?
                <br>Accéder à <a href="#">l'espace professionnel</a></p>
            </div>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/create_account.js"></script>
    </body>
</html>
