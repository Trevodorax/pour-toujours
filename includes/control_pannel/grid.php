<?php

// checks if grid type exists
$possible_grid_types = ['repas', 'animation', 'lieu', 'tenue', 'photos'];
if(!in_array($_GET['type'], $possible_grid_types)){
    header('location: control_pannel.php');
    exit;
}

// getting the service for this page
switch($_GET[('type')]){
    case('repas'):
        $current_service = $repas_service;
        break;
    case('animation'):
        $current_service = $animation_service;
        break;
    case('lieu'):
        $current_service = $lieu_service;
        break;
    case('tenue'):
        $current_service = $tenue_service;
        break;
    case('photos'):
        $current_service = $photos_service;
        break;
}

// gets all info needed in this page about a service
function get_service_info($id_service){
    include('includes/db.php');

    // getting info from the SERVICE table
    $q = "SELECT nom, prestataire FROM SERVICE WHERE id = ?";
    $req_service = $bdd->prepare($q);
    $req_service->execute([$id_service]);
    $service_info = $req_service->fetchAll()[0];

    // getting info from PRESTATAIRE table
    $q = "SELECT metier, photoProfil, personne  FROM PRESTATAIRE WHERE id = ?";
    $req_presta = $bdd->prepare($q);
    $req_presta->execute([end($service_info)]);
    $presta_info = $req_presta->fetchAll()[0];

    // getting info from PERSONNE table
    $q = "SELECT nomPrefere, departement FROM PERSONNE WHERE id = ?";
    $req_personne = $bdd->prepare($q);
    $req_personne->execute([end($presta_info)]);
    $personne_info = $req_personne->fetchAll()[0];

    return [$service_info, $presta_info, $personne_info];

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
            var_dump(get_service_info($current_service));
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