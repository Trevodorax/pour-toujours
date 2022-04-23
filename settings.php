<?php session_start() ;
include('includes/db.php');

function isCustomer(){
    if(empty($_SESSION['emailPro'])){
        return true;
    }
}
function add_label($name, $value){
        echo '<label for="'. $name .'">Valeur enregistrée: ' . $value . '</label>';
}

if (isCustomer()){
    $className = "pouf";
} else{
    $className = " ";
}

function getAvatar($id_personne) {
    include('includes/db.php');
    $q = 'SELECT avatar FROM UTILISATEUR WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$id_personne]);
    return $req->fetchAll()[0][0];
}

function drawAvatar($avatar_specs) {
    $colors = ['blue', 'pink', 'green'];
    echo '<div id="avatar" class="' . $colors[$avatar_specs[7] - 1] . '">';
        echo '<div id="hair' . $avatar_specs[0] . '" class="hair"></div>';
        echo '<div id="face' . $avatar_specs[1] . '" class="face"></div>';
        echo '<div id="eyes' . $avatar_specs[2] . '" class="eyes"></div>';
        echo '<div id="nose' . $avatar_specs[3] . '" class="nose"></div>';
        echo '<div id="mouth' . $avatar_specs[4] . '" class="mouth"></div>';
        echo '<div id="chest' . $avatar_specs[5] . '" class="chest"></div>';
        echo '<div id="detail' . $avatar_specs[6] . '" class="detail"></div>';
    echo '</div>';
}

?>

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
                <p>Activer le mode sombre</p>
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

                <div id="avatar-area">
                    <p>Personnaliser mon avatar</p>

                    <?php
                        // for the loop that will create side arrows
                        $avatar_parts = ['hair', 'face', 'eyes', 'nose', 'mouth', 'detail'];
                    ?>

                    <div id="avatar-maker">
                        <div class="avatar-arrows">
                            <img src="images/go_icon.svg" onclick="changeAvatarColor(false)">
                            <?php
                                foreach($avatar_parts as $part) {
                                    echo '<img src="images/go_icon.svg" onclick="changeAvatar(this, \'' . $part . '\', false)" for="' . $part . '">';
                                }
                            ?>
                        </div>
                        <?php
                            $avatar_specs = getAvatar($_SESSION['id']);
                            if($avatar_specs){
                                drawAvatar($avatar_specs);
                            }
                        ?>
                        <div class="avatar-arrows">
                            <img src="images/go_icon.svg" onclick="changeAvatarColor(true)">
                            <?php
                            foreach($avatar_parts as $part) {
                                echo '<img src="images/go_icon.svg" onclick="changeAvatar(this, \'' . $part . '\', true)" for="' . $part . '">';
                            }
                            ?>
                        </div>
                    </div>

                    <button class="btn btn-primary" id="save-avatar" onclick="saveAvatar()">Sauvegarder l'avatar</button>

                    <section id="account-modification">
                      <p>Modifier mon mot de passe</p>
                      <p>Supprimer mon compte</p>
                      <p>Télécharger toutes mes informations (RGPD)</p>

                      <p id="title">Modifier mes informations personnelles</p>

                      <!-- REQUEST TO GET THE MISSING INFORMATIONS (NOT SET IN SESSION) ABOUT THE PROFILE -->
                        <?php

                        //Add some parameters if the user is a services provider
                        if (!isCustomer()){
                            $extra = [
                                ",nomEntreprise, metier, emailPro, telPro, description,photoProfil,lienSiteWeb", 
                                "INNER JOIN PRESTATAIRE ON personne = PERSONNE.id"
                            ];
                        } else {
                            $extra = [" ", " "];
                            
                        }
                      
                        $q = 'SELECT DATE_FORMAT(date_naissance, "%e/%m/%Y") as naissance, numero_tel, genre' . $extra[0] . ' FROM PERSONNE ' . $extra[1]. ' WHERE PERSONNE.id = :id ';
                        $req = $bdd->prepare($q);
                        $req->execute(['id' => $_SESSION['id']]);
                        $results= $req->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                      <!-- Displaying old values AND Form to change them if need be -->
                      <div class="changing-forms">
                        <?php 
                               if(isset($_GET['message']) && !empty($_GET['message'])) {

                                echo ' <p id="error-message">'. $_GET['message'] . '</p>';
                            }

                            function create_form($old_value, $name, $placeholder, $columnName ){
                            
                                echo '<form method="post" action ="check_profile_modification.php" enctype="multipart/form-data"> ' ;
                                echo ' <label for="new_value">Valeur enregistrée: '. $old_value . '</label>';
                                echo '<input type="text" name="'. $name .'" class="required-input" placeholder="'.$placeholder.'">';
                                echo '<input type="hidden" name="column" value=' . $columnName . '>';
                                echo '<input type="submit">';

             

                                echo '</form>';
                            }     
                            
                            create_form($_SESSION['nomComplet'], "c_name", "Votre nouveau nom complet", "nomComplet");
                            create_form($_SESSION['nomPrefere'], "f_name", "Votre nouveau nom prefere", "nomPrefere");
                            create_form($results[0]['naissance'], "b_date", "Votre date de naissance", "date_naissance");                   
                        ?>

                        <?php if (!isCustomer()){
                            echo '<form method="post" action ="check_profile_modification.php" enctype="multipart/form-data">';
                            add_label("company_name", $results[0]['nomEntreprise']);
                              echo ' <input class="'. $className .'pro-form required-input" type="text" name="company_name" placeholder="Nouveau nom de votre entreprise">
                                    <input type="submit">
                                    <input type="hidden" name="column" value="nomEntreprise">
                            </form>';
                        }
                            ?>
                            
                            <form method="post" action ="check_profile_modification.php" enctype="multipart/form-data">
                                <label for="departement"><? echo 'Valeur enregistrée: '. $_SESSION['departement'] ?></label>        
                                <select id="region" name="departement" class="required-input">

                                    <?php
                                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un département ---</option>";
                                        $departement_options = ["01 - Ain", "02 - Aisne","03 - Allier","04 - Alpes-de-Haute-Provence","05 - Hautes-alpes","06 - Alpes-maritimes","07- Ardèche","08 - Ardennes","09 - Ariège","10 - Aube","11 - Aude","12 - Aveyron","13 - Bouches-du-Rhône","14 - Calvados","15 - Cantal","16 - Charente","17 - Charente-maritime","18 - Cher","19 - Corrèze","2A - Corse-du-sud","2B - Haute-Corse","21 - Côte-d'Or","22 - Côtes-d'Armor","23 - Creuse","24 - Dordogne","25 - Doubs","26 - Drôme","27 - Eure","28 - Eure-et-loir","29 - Finistère","30 - Gard","31 - Haute-garonne","32 - Gers","33 - Gironde","34 - Hérault","35 - Ille-et-vilaine","36 - Indre","37 - Indre-et-loire","38 - Isère","39 - Jura","40 - Landes", "41 - Loir-et-cher","42 - Loire","43 - Haute-loire","44 - Loire-atlantique","45 - Loiret","46 - Lot","47 - Lot-et-garonne","48 - Lozère","49 - Maine-et-loire","50 - Manche","51 - Marne","52 - Haute-marne","53 - Mayenne","54 - Meurthe-et-moselle","55 - Meuse","56 - Morbihan","57 - Moselle","58 - Nièvre","59 - Nord","60 - Oise","61 - Orne","62 - Pas-de-calais","63 - Puy-de-dôme","64 - Pyrénées-atlantiques","65 - Hautes-Pyrénées","66 - Pyrénées-orientales","67 - Bas-rhin","68 - Haut-rhin","69 - Rhône","70 - Haute-saône","71 - Saône-et-loire","72 - Sarthe","73 - Savoie","74 - Haute-savoie","75 - Paris","76 - Seine-maritime","77 - Seine-et-marne","78 - Yvelines","79 - Deux-sèvres","80 - Somme","81 - Tarn","82 - Tarn-et-Garonne","83 - Var","84 - Vaucluse","85 - Vendée","86 - Vienne","87 - Haute-vienne","88 - Vosges","89 - Yonne","90 - Territoire de belfort","91 - Essonne","92 - Hauts-de-seine","93 - Seine-Saint-Denis","94 - Val-de-marne","95 - Val-d'Oise","971 - Guadeloupe","972 - Martinique","973 - Guyane","974 - La réunion","976 - Mayotte"];
                                        foreach ($departement_options as $departement){
                                            echo "<option value='$departement'>$departement</option>";
                                        }
                                    ?>
                                </select>
                                <input type="submit">
                                <input type="hidden" name="column" value="departement">
                            </form>

                            <?php 
                                  create_form($results[0]['numero_tel'], "tel","Votre nouveau numéro de télephone", "numero_tel");
                            ?>
                            <?php if (!isCustomer()){
                            echo '<form method="post" action ="check_profile_modification.php" enctype="multipart/form-data">';                         
                            add_label("tel_pro", $results[0]['telPro']);
                               echo ' <input class="'.$className. ' required-input pro-form" type="tel" name="tel_pro" placeholder=" Votre nouveau numéro de téléphone professionnel">
                                <input type="hidden" name="column" value="telPro">
                                <input type="submit">
                            </form>';
                            }
                            ?>
               
                            <?php 
                                  create_form($_SESSION['email'], "email", "Votre nouvel email", "email");
                            ?>
                             <?php if (!isCustomer()){
                            echo '<form method="post" action ="check_profile_modification.php" enctype="multipart/form-data">';                         
                            add_label("email_pro", $results[0]['emailPro']);
                            echo   '<input class="' . $className . 'required-input pro-form" type="email" name="email_pro" placeholder=" Votre e-mail professionnel">
                                    <input type="hidden" name="column" value="emailPro">
                                    <input type="submit">
                                </form>';
                             }
                            ?>
                            
                            <form action="check_profile_modification.php" method="POST">
                                <?php $var = $results[0]['genre'] == 'H' ? 'Homme' : ($results[0]['genre'] == 'F' ? 'Femme' : 'Autre'); ?>
                                <label for="genre"><?= 'Valeur enregistrée: ' . $var ?></label>        
                                <select id="genre" name="genre" class="required-input">
                                    <?php
                                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un genre ---</option>";
                                        $gender_options = ["Homme","Femme","Autre","Préfère ne pas répondre"];
                                        foreach ($gender_options as $genre){
                                            echo "<option value='$genre'>$genre</option>";
                                        }
                                    ?>
                                </select>
                                <input type="hidden" name="column" value="genre">
                                <input type="submit">
                            </form>
                            
                            
                            <?php if (!isCustomer()){
                                echo '<form action="check_profile_modification.php" method="POST">';
                                add_label("activite", $results[0]['metier']);
                                echo '<select class="'. $className . '  required-input pro-form" id="activite" name="activite">';
                                   
                                        echo "<option disabled='disabled' selected='true' hidden> --- Sélectionner un secteur d'activité ---</option>";
                                        $activite_options = ["Photographie", "Cuisine", "Décoration", "Fleuriste"];
                                        foreach ($activite_options as $activite){
                                            echo "<option value='$activite'>$activite</option>";
                                        }
                                
                                echo '</select>';
                                echo '<input type="hidden" name="column" value="metier">';
                                echo '<input type="submit">';
                            echo '</form>' ;
                                    } ?>

                            <?php if (!isCustomer()){
                                create_form($results[0]['lienSiteWeb'],"site", "Nouveau lien du site web", "lienSiteWeb");}
                            ?>

                            <?php if (!isCustomer()){
                            echo '<form action="check_profile_modification.php" method="post" enctype="multipart/form-data"> ';    
                            add_label("image", $results[0]['photoProfil']);
                            echo ' <input type="file" name="image" class="'.$className.' required-input pro-form" placeholder="Votre image de profil">';
                            echo ' <input type="hidden" name="column" value="photoProfil">';
                            echo ' <input type="submit">';
                            echo '</form>';
                            }
                            ?>
                         </div>               
                                
                    </section>

                </div>
            </section>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/settings.js"></script>
        <script src="scripts/change_avatar.js"></script>
    </body>
</html>
