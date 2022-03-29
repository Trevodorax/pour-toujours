<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/create_account.css">
    </head>
    <body>
        <?php include('includes/header.php'); ?>

        <main>
            <h2>Créer un compte<span class="user-form" onclick="switch_forms()" id="top-right-acces-pro">Accès pro</span><span class="pro-form" onclick="switch_forms()" id="top-right-acces-pro"r>Accès utilisateur</span></h2>
            <p>Saisissez vos informations pour continuer</p>
            <p class="pro-form">Vous pourrez présenter vos services en détail dans votre profil après vous être créer un compte.</p>
            <form method="post" action ="check_sign_up.php">
                <input type="text" name="c_name" class="required-input" placeholder=" Votre nom complet">

                <input type="text" name="f_name" class="required-input" placeholder=" Votre nom préféré">

                <input class="date_input" type="date" name="b_date" class="required-input" placeholder=" Votre date de naissance">

                <input class="pro-form" type="text" name="company_name" placeholder=" Nom de votre entreprise">

                <select id="region" name="region" placeholder="test">
                    <?php
                        echo "<option disabled='disabled' selected='true'> --- Sélectionner une région ---</option>";
                        $region_options = ["Auvergne-Rhône-Alpes", "Bourgogne-Franche-Comté", "Bretagne", "Centre-Val de Loire", "Corse", "Grand Est", "Hauts-de-France", "Ile-de-France","Normandie","Nouvelle-Aquitaine","Occitanie","Pays-de-la-Loire","Provence-Alpes-Côte d’Azur"];
                        foreach ($region_options as $region){
                            echo "<option value='$region'>$region</option>";
                        }
                    ?>
                </select>

                <input type="tel" name="tel" placeholder=" Votre numéro de téléphone">

                <input class="pro-form" type="tel" name="tel_pro" placeholder=" Votre numéro de téléphone professionnel">

                <input type="email" name="email" class="required-input" placeholder=" Votre e-mail">

                <input class="pro-form" type="email" name="email_pro" placeholder=" Votre e-mail professionnel">

                <input type="password" name="password" class="required-input" placeholder=" Votre mot de passe">

                <input type="password" name="confirm_password" class="required-input" placeholder=" Confirmez votre mot de passe">

                <select id="genre" name="genre">
                    <?php
                        echo "<option disabled='disabled' selected='true'> --- Sélectionner un genre ---</option>";
                        $gender_options = ["Homme","Femme","Autre","Préfère ne pas répondre"];
                        foreach ($gender_options as $genre){
                            echo "<option value='$genre'>$genre</option>";
                        }
                    ?>
                </select>

                <select class="pro-form " id="activite" name="activite">
                    <?php
                        echo "<option disabled='disabled' selected='true'> --- Sélectionner un secteur d'activité ---</option>";
                        $activite_options = ["Photographie", "Cuisine", "Décoration de salles", "Fleuriste"];
                        foreach ($activite_options as $activite){
                            echo "<option value='$activite'>$activite</option>";
                        }
                    ?>
                </select>

                <div class="checkbox-line">
                    <input type="checkbox" name="pro_access" id="pro-checkbox">
                    <span>Créer un compte professionnel</span>
                </div>
                <div class="checkbox-line">
                    <input class="must-check" type="checkbox" name="certified_adult">
                    <span>J'accepte la politique de confidentialité du site. Je certifie avoir 18 ans révolus.</span>
                </div>

                <div class="checkbox-line">
                    <input type="checkbox" name="email_list">
                    <span>Si vous souhaitez recevoir des notifications par mail, veuillez cocher la case ci-contre.</span>
                </div>

                <p id="champs-obligatoires">Les champs marqués d'une * sont obligatoires.</p>

                <?php include('includes/captcha.php'); ?>

                <button id="validate-button" class="big-red-button no-click"><p>Créer mon compte</p></button>

            </form>

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
