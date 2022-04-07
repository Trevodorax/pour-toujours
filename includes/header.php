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
        <a href="#">Prestataires</a>
        <?php
        if(isset($_SESSION['email'])){
            echo '<a href="control_pannel.php">Mon compte</a>
                    <a href="log_out.php">Deconnexion</a>';
        }else{
            echo '<a href="create_account.php">S\'inscrire</a>
                    <a href="log_in.php">Se connecter</a>';
        }
        ?>
    </nav>
</header>
<div id="header-wave"></div>
<nav id="burger-menu" class="desktop-hidden pouf">
    <a href="https://www.google.com/"><h3>Nos partenaires<img src="images/go_icon.svg"></h3></a>
    <a href="create_account.php"><h3>Accès professionnels<img src="images/go_icon.svg"></h3></a>
    <a href="#"><h3>Trouvez l'inspiration<img src="images/go_icon.svg"></h3></a>
    <a href="FAQ.php"><h3>F.A.Q<img src="images/go_icon.svg"></h3></a>
    <button class="big-red-button"><p>Se connecter</p></button>
</nav>

