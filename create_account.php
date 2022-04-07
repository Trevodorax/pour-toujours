<?php session_start() ?>

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
            <form method="post" action ="check_sign_up.php" enctype="multipart/form-data">
                <input type="text" name="c_name" class="required-input" placeholder=" Votre nom complet" value="<?= isset($_COOKIE['nomcomplet']) ? $_COOKIE['nomcomplet'] : '' ?>">

                <input type="text" name="f_name" class="required-input" placeholder=" Votre nom préféré" value="<?= isset($_COOKIE['nomprefere']) ? $_COOKIE['nomprefere'] : '' ?>">

                <input class="date_input" type="date" name="b_date" class="required-input" placeholder=" Votre date de naissance">

                <input class="pro-form" type="text" name="company_name" placeholder=" Nom de votre entreprise" value="<?= isset($_COOKIE['nomentreprise']) ? $_COOKIE['nomentreprise'] : '' ?>">

                <select id="region" name="departement">
                    <?php
                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un département ---</option>";
                        $departement_options = ["01 - Ain", "02 - Aisne","03 - Allier","04 - Alpes-de-Haute-Provence","05 - Hautes-alpes","06 - Alpes-maritimes","07 - Ardèche","08 - Ardennes","09 - Ariège","10 - Aube","11 - Aude","12 - Aveyron","13 - Bouches-du-Rhône","14 - Calvados","15 - Cantal","16 - Charente","17 - Charente-maritime","18 - Cher","19 - Corrèze","2A - Corse-du-sud","2B - Haute-Corse","21 - Côte-d'Or","22 - Côtes-d'Armor","23 - Creuse","24 - Dordogne","25 - Doubs","26 - Drôme","27 - Eure","28 - Eure-et-loir","29 - Finistère","30 - Gard","31 - Haute-garonne","32 - Gers","33 - Gironde","34 - Hérault","35 - Ille-et-vilaine","36 - Indre","37 - Indre-et-loire","38 - Isère","39 - Jura","40 - Landes", "41 - Loir-et-cher","42 - Loire","43 - Haute-loire","44 - Loire-atlantique","45 - Loiret","46 - Lot","47 - Lot-et-garonne","48 - Lozère","49 - Maine-et-loire","50 - Manche","51 - Marne","52 - Haute-marne","53 - Mayenne","54 - Meurthe-et-moselle","55 - Meuse","56 - Morbihan","57 - Moselle","58 - Nièvre","59 - Nord","60 - Oise","61 - Orne","62 - Pas-de-calais","63 - Puy-de-dôme","64 - Pyrénées-atlantiques","65 - Hautes-Pyrénées","66 - Pyrénées-orientales","67 - Bas-rhin","68 - Haut-rhin","69 - Rhône","70 - Haute-saône","71 - Saône-et-loire","72 - Sarthe","73 - Savoie","74 - Haute-savoie","75 - Paris","76 - Seine-maritime","77 - Seine-et-marne","78 - Yvelines","79 - Deux-sèvres","80 - Somme","81 - Tarn","82 - Tarn-et-Garonne","83 - Var","84 - Vaucluse","85 - Vendée","86 - Vienne","87 - Haute-vienne","88 - Vosges","89 - Yonne","90 - Territoire de belfort","91 - Essonne","92 - Hauts-de-seine","93 - Seine-Saint-Denis","94 - Val-de-marne","95 - Val-d'Oise","971 - Guadeloupe","972 - Martinique","973 - Guyane","974 - La réunion","976 - Mayotte"];
                        foreach ($departement_options as $departement){
                            echo "<option value='$departement'>$departement</option>";
                        }
                    ?>
                </select>

                <input type="tel" name="tel" placeholder=" Votre numéro de téléphone" value="<?= isset($_COOKIE['numero_tel']) ? $_COOKIE['numero_tel'] : '' ?>">

                <input class="pro-form" type="tel" name="tel_pro" placeholder=" Votre numéro de téléphone professionnel" value="<?= isset($_COOKIE['telpro']) ? $_COOKIE['telpro'] : '' ?>">

                <input type="email" name="email" class="required-input" placeholder=" Votre e-mail" value="<?= isset($_COOKIE['email']) ? $_COOKIE['email'] : '' ?>">

                <input class="pro-form" type="email" name="email_pro" placeholder=" Votre e-mail professionnel" value="<?= isset($_COOKIE['emailpro']) ? $_COOKIE['emailpro'] : '' ?>">

                <input type="password" name="password" class="required-input" placeholder=" Votre mot de passe">

                <input type="password" name="confirm_password" class="required-input" placeholder=" Confirmez votre mot de passe">

                <select id="genre" name="genre">
                    <?php
                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un genre ---</option>";
                        $gender_options = ["Homme","Femme","Autre","Préfère ne pas répondre"];
                        foreach ($gender_options as $genre){
                            echo "<option value='$genre'>$genre</option>";
                        }
                    ?>
                </select>

                <select class="pro-form" id="activite" name="activite">
                    <?php
                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un secteur d'activité ---</option>";
                        $activite_options = ["Photographie", "Cuisine", "Décoration", "Fleuriste"];
                        foreach ($activite_options as $activite){
                            echo "<option value='$activite'>$activite</option>";
                        }
                    ?>
                </select>

                <input type="text" name="site" class="pro-form" placeholder=" Lien de votre site" value="<?= isset($_COOKIE['liensiteweb']) ? $_COOKIE['liensiteweb'] : '' ?>">

                <input type="file" name="image" class="pro-form" placeholder=" Votre image de profil">

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
                <p>Vous avez déjà un compte ? <a href="log_in.php">Se connecter</a></p>
                <p class="user-form" onclick="switch_forms()">Vous souhaitez proposer vos services ?
                <br>Accéder à <a href="#">l'espace professionnel</a></p>
            </div>
        </main>

        

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/create_account.js"></script>
    </body>
</html>
