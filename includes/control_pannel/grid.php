<?php

$possible_grid_types = ['repas', 'animation', 'lieu', 'tenue', 'photos'];

if(!in_array($_GET['type'], $possible_grid_types)){
    header('location: control_pannel.php');
    exit;
}

?>


<main id="grid-main">
    <section id="mobile-control-nav">
        <p id="nav-opener">Mon panneau de contrôle</p>
        <nav>
            <br>
            <a href="#">Vue générale sur mon mariage</a>
            <a href="#">Mes messages privés</a>
            <a href="#">Mon lieu de mariage</a>
            <a href="#">Mon animation</a>
            <a href="#">Mes photos</a>
            <a href="#">Mon repas</a>
            <a href="#">Ma tenue</a>
            <a href="#">Ma liste d'invités</a>
            <a href="#">Mes favoris</a>
            <a href="#">Mes paramètres</a>
        </nav>
    </section>
    <h2><?= ucwords($_GET['type']) ?> pour le mariage :</h2>
    <div>
        <?php
        if($has_services){
            echo "<h2>Notre sélection pour vous :</h2>";
        }else{
            echo "<h2><a href='search_pro.php?type=" . $_GET['type'] . "'>Aller voir les prestataires de la catégorie " . $_GET['type'] . "</a></h2>";
        }
        ?>

        <!--
        <div id="grid-items">
            <a class="grid-card">
                <img src="images/home_circle.jpg">
                <div>
                    <h4>Plaza Henest Dan</h4>
                    <p>Plage des diamants<br>Paris 75001</p>
                </div>
            </a>
            <a class="grid-card">
                <img src="images/home_circle.jpg">
                <div>
                    <h4>Plaza Henest Dan</h4>
                    <p>Plage des diamants<br>Paris 75001</p>
                </div>
            </a>
            <a class="grid-card">
                <img src="images/home_circle.jpg">
                <div>
                    <h4>Plaza Henest Dan</h4>
                    <p>Plage des diamants<br>Paris 75001</p>
                </div>
            </a>
            <a class="grid-card">
                <img src="images/home_circle.jpg">
                <div>
                    <h4>Plaza Henest Dan</h4>
                    <p>Plage des diamants<br>Paris 75001</p>
                </div>
            </a>
        </div>
        <a id="load-content" href="#">Voir plus...</a>
        -->
    </div>
</main>