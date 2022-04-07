<header id="mobile-header">
    <a></a>
    <a href="index.php"></a>
    <a href="create_account.php"></a>
</header>
<header id="desktop-header" class="mobile-hidden">
    <a href="index.php">
        <img src="images/pt_logo.svg">
        <img src="images/text_logo.svg">
    </a>
    <nav>
        <a href="FAQ.php">FAQ</a>
        <a href="search_pro">Prestataires</a>
        <?php

        //display a different page based on what kind of user is logged in
        if (!empty($_SESSION['emailpro'])){
                $profile_page = 'pro_profile.php' ;
                $word = 'pro';
             } else {
                $profile_page = 'control_pannel.php';
                $word = ' ';
             }
        //display this nav if a user is logged in
        if(isset($_SESSION['email'])){
            echo '<a href="'. $profile_page . '">Mon compte '.$word.'</a>
                    <a href="log_out.php">Deconnexion</a>';

        }else{
            //display this nav if a user is NOT logged in
            echo '<a href="create_account.php">S\'inscrire</a>
                    <a href="log_in.php">Se connecter</a>';
        }
        ?>
    </nav>
</header>
<div id="header-wave"></div>
<nav id="burger-menu" class="desktop-hidden pouf">
    <!-- The burger menu isn't working yet -->
    <a href="search_pro"><h3>Nos partenaires<img src="images/go_icon.svg"></h3></a>
    <a href="create_account.php"><h3>Accès professionnels<img src="images/go_icon.svg"></h3></a>
    <a href="#"><h3>Trouvez l'inspiration<img src="images/go_icon.svg"></h3></a>
    <a href="FAQ.php"><h3>F.A.Q<img src="images/go_icon.svg"></h3></a>
    <button class="big-red-button"><p>Se connecter</p></button>
</nav>

