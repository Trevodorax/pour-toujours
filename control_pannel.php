<?php
session_start();

function isLogged(){
    if( isset($_SESSION['email'])) {
        return true;
    }
}

if(!isLogged()){
    header('location: index.php?message=Vous n\'avez pas accès à cette page');
    exit;
}

?>

<?php
    $possible_pages = ["home", "messages", "grid"];
    if(isset($_GET['page']) && in_array($_GET['page'], $possible_pages)){
        $current_page = $_GET['page'];
    }else{
        header('location: control_pannel.php?page=home');
        exit;
    }

    if($current_page == 'grid' && !isset($_GET['type'])){
        header('location: control_pannel.php?page=home');
        exit;
    }
?>

<?php
    include('includes/db.php');

    if($current_page == 'grid'){
        $q = "SELECT id FROM SERVICE WHERE type = :type AND id IN (SELECT service FROM DEMANDE WHERE mariage = (SELECT id FROM MARIAGE WHERE utilisateur = (SELECT id FROM UTILISATEUR WHERE personne = :id_personne)))";
        $req = $bdd->prepare($q);

        $req->execute([
            'type' => 'N',
            'id_personne' => $_SESSION['id']
        ]);
        $nourriture_service = $req->fetchAll();

        // get the other services only if nourriture exists (otherwise none of them exists)
        if(count($nourriture_service) > 0){
            $has_services = true;

            $nourriture_service = $nourriture_service[0][0];

            $req->execute([
                'type' => 'A',
                'id_personne' => $_SESSION['id']
            ]);
            $animation_service = $req->fetchAll()[0][0];

            $req->execute([
                'type' => 'L',
                'id_personne' => $_SESSION['id']
            ]);
            $lieu_service = $req->fetchAll()[0][0];

            $req->execute([
                'type' => 'T',
                'id_personne' => $_SESSION['id']
            ]);
            $tenue_service = $req->fetchAll()[0][0];

            $req->execute([
                'type' => 'P',
                'id_personne' => $_SESSION['id']
            ]);
            $photos_service = $req->fetchAll()[0][0];
        }else{
            $has_services = false;
        }


    }
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/control_pannel/control_pannel.css">
        <link rel="stylesheet" href="style/control_pannel/<?=$current_page?>.css">
    </head>
    <body>
        <?php include('includes/header.php'); ?>
        <div id="page-top">
            <div>
                <?php
                    echo '<h2>Bonjour, ' . $_SESSION['nomprefere'] . ' !</h2>';
                ?>
                <p>Prêt à continuer l'aventure ?</p>
            </div>
            <div id="time-left">
                <img src="images/clock_icon.svg"> J-67
            </div>
        </div>

        <nav id="desktop-control-nav">
            <a href="control_pannel.php?page=home" class="<?php echo $current_page == "home" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_general.svg"><p>Mon&nbspmariage</p></a>
            <a href="control_pannel.php?page=messages" class="<?php echo $current_page == "messages" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_bulle.svg"><p>Mes&nbspmessages</p></a>
            <a href="control_pannel.php?page=grid&type=lieu" class="<?php echo $current_page == "grid" && $_GET['type'] == "lieu" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_lieu.svg"><p>Lieu&nbspde&nbspmariage</p></a>
            <a href="control_pannel.php?page=grid&type=animation" class="<?php echo $current_page == "grid" && $_GET['type'] == "animation" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_animation.svg"><p>Mon&nbspanimation</p></a>
            <a href="control_pannel.php?page=grid&type=photo" class="<?php echo $current_page == "grid" && $_GET['type'] == "photo" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_photo.svg"><p>Mes&nbspphotos</p></a>
            <a href="control_pannel.php?page=grid&type=repas" class="<?php echo $current_page == "grid" && $_GET['type'] == "repas" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/pitco_repas.svg"><p>Mon&nbsprepas</p></a>
            <a href="control_pannel.php?page=grid&type=favoris" class="<?php echo $current_page == "grid" && $_GET['type'] == "favoris" ? 'active-nav-item' : '' ?>"><img src="images/control_nav_pictos/picto_coeur.svg"><p>Mes&nbspfavoris</p></a>
            <a href="control_pannel.php?page=invites"><img src="images/control_nav_pictos/picto_invites.svg"><p>Mes&nbspinvités</p></a>
            <a href="settings.php"><img src="images/control_nav_pictos/picto_parametre.svg"><p>Paramètres</p></a>
        </nav>

        <?php include('includes/control_pannel/'. $current_page . '.php'); ?>

        <?php include('includes/footer.php'); ?>
        <script src="scripts/index.js"></script>
        <script src="scripts/control_pannel.js"></script>
    </body>
</html>
