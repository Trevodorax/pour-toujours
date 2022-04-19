<?php

// checks if grid type exists
$possible_grid_types = ['repas', 'animation', 'lieu', 'tenue', 'photos'];
if(!in_array($_GET['type'], $possible_grid_types)){
    header('location: control_pannel.php');
    exit;
}

// getting the service for this page
if($has_services){
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
    $q = "SELECT id, metier, photoProfil, emailPro, personne  FROM PRESTATAIRE WHERE id = ?";
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
            $service_info = get_service_info($current_service);
            $path = 'images/prestataires';
            // service part
            echo
                '
                <h3>Service :</h3>
                <p>' . $service_info[0]['nom']   . '</p>
                ';
            // prestataire part
            echo
                '
                <h3>Organisé par :</h3>
                <div class="presta-card">
                    <img src="'. $path . '/' . $service_info[1]['photoProfil'] . '">
                    <div>
                        <h3><a href="pro_profile_for_user.php?pro=' . $service_info[1]['id'] . '">' . $service_info[2]['nomPrefere'] . '</a></h3>
                        <h4>' . $service_info[1]['metier'] . '</h4>
                        <p>Departement : '. $service_info[2]['departement'] .'</p>
                        <a id="contact" href="control_pannel.php?page=messages&destinataire='. $service_info[1]['emailPro'] .'">Contacter <img src="images/presta_contact_icon.svg"></a>
                    </div>
                </div>
                ';

        }else{
            echo "<button class='big-red-button'><a href='search_pro.php?type=" . $_GET['type'] . "'>Aller voir les prestataires de la catégorie " . $_GET['type'] . "</a></button>";
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