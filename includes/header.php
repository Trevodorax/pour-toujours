<header id="mobile-header">
    <a></a>
    <a href="index.php"></a>
     <?php  
        if(isset($_SESSION['email'])){ 
           echo' <a href="log_out.php"></a>';
        } else {
            echo '<a href="create_account.php"></a>';
        }
       ?>
    
</header>
<header id="desktop-header" class="mobile-hidden">
    <a href="index.php">
        <img src="images/pt_logo.svg">
        <img src="images/text_logo.svg">
    </a>
    <nav>
        <a href="FAQ.php">FAQ</a>
        <a href="search_pro.php">Prestataires</a>
        <?php

        //display a different page based on what kind of user is logged in
        if (!empty($_SESSION['emailPro'])){
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
    <a href="search_pro.php"><h3>Prestataires<img src="images/go_icon.svg"></h3></a>
    <a href="FAQ.php"><h3>FAQ<img src="images/go_icon.svg"></h3></a>
    <?php
            if (!empty($_SESSION['emailPro'])){
                $profile_page = 'pro_profile.php' ;
                $word = 'pro';
             } else {
                $profile_page = 'control_pannel.php';
                $word = ' ';
             }
        //display this nav if a user is logged in
        if(isset($_SESSION['email'])){
            echo '<a href="'. $profile_page . '"><h3>Mon compte '.$word.'<img src="images/go_icon.svg"><h3></a>';
            echo '<button class="big-red-button"><p><a href="log_out.php">Déconnexion</a></p></button>';

        }else{
            //display this nav if a user is NOT logged in
            echo '<a href="create_account.php"><h3>S\'inscrire<img src="images/go_icon.svg"></h3></a>';
            echo '<button class="big-red-button"><p><a href="log_in.php">Se connecter</a></p></button>';
        } ?>
    <!-- <a href="create_account.php"><h3>Accès professionnels<img src="images/go_icon.svg"></h3></a>
    <a href="FAQ.php"><h3>F.A.Q<img src="images/go_icon.svg"></h3></a>
    <button class="big-red-button"><p>Se connecter</p></button> -->
</nav>

