<?php
    $possible_pages = ["home", "messages", "grid"];
    if(isset($_GET['page']) && in_array($_GET['page'], $possible_pages)){
        $current_page = $_GET['page'];
    }else{
        header('location: control_pannel.php?page=home');
        exit;
    }
    include('includes/db.php');
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
                    echo '<h2>Bonjour, ' . $_SESSION['nomprefere'] . '!</h2>';
                ?>
                <p>Prêt à continuer l'aventure ?</p>
            </div>
            <div id="time-left">
                <img src="images/clock_icon.svg"> J-67
            </div>
        </div>

        <nav id="desktop-control-nav">
            <a href="control_pannel.php?page=home" class="active-nav-item"><img src="images/control_nav_pictos/picto_general.svg"><p>Mon&nbspmariage</p></a>
            <a href="control_pannel.php?page=messages"><img src="images/control_nav_pictos/picto_bulle.svg"><p>Mes&nbspmessages</p></a>
            <a href="control_pannel.php?page=lieu"><img src="images/control_nav_pictos/picto_lieu.svg"><p>Lieu&nbspde&nbspmariage</p></a>
            <a href="control_pannel.php?page=animation"><img src="images/control_nav_pictos/picto_animation.svg"><p>Mon&nbspanimation</p></a>
            <a href="control_pannel.php?page=photo"><img src="images/control_nav_pictos/picto_photo.svg"><p>Mes&nbspphotos</p></a>
            <a href="control_pannel.php?page=repas"><img src="images/control_nav_pictos/pitco_repas.svg"><p>Mon&nbsprepas</p></a>
            <a href="control_pannel.php?page=favoris"><img src="images/control_nav_pictos/picto_coeur.svg"><p>Mes&nbspfavoris</p></a>
            <a href="control_pannel.php?page=invites"><img src="images/control_nav_pictos/picto_invites.svg"><p>Mes&nbspinvités</p></a>
            <a href="control_pannel.php?page=parametres"><img src="images/control_nav_pictos/picto_parametre.svg"><p>Paramètres</p></a>
        </nav>

        <?php include('includes/control_pannel/'. $current_page . '.php'); ?>

        <?php include('includes/footer.php'); ?>
        <script src="scripts/index.js"></script>
        <script src="scripts/control_pannel.js"></script>
    </body>
</html>
