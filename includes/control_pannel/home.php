<?php
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
            echo '<div id="hair' . $avatar_specs[0] . '"></div>';
            echo '<div id="face' . $avatar_specs[1] . '"></div>';
            echo '<div id="eyes' . $avatar_specs[2] . '"></div>';
            echo '<div id="nose' . $avatar_specs[3] . '"></div>';
            echo '<div id="mouth' . $avatar_specs[4] . '"></div>';
            echo '<div id="chest' . $avatar_specs[5] . '"></div>';
            echo '<div id="detail' . $avatar_specs[6] . '"></div>';
        echo '</div>';
    }
?>

<main id="home-main">
    <section>
        <!-- MODIFY THE IDs AND CLASSES TO PIMP THE AVATAR -->
        <?php
            $avatar_specs = getAvatar($_SESSION['id']);
            if($avatar_specs){
                drawAvatar($avatar_specs);
            }
        ?>
        <a href="settings.php"><h3>Personnaliser mon avatar<img src="images/go_icon.svg"></h3></a>
    </section>
    <section id="launch-QCM">
        <p>Vous ne savez pas par où démarrer ?  Nous vous avons préparé un QCM justement fait pour ça !</p>
            <a href="QCM.php"><h3>Lancer le QCM<img src="images/go_icon.svg"></h3></a>
    </section>

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

    <section id="vue-generale">
        <h2>Vue générale sur mon mariage</h2>
        <p>Date : 28/05/22</p>
        <table>
            <tr>
                <td>Mon lieu de mariage</td>
                <td>OK</td>
            </tr>
            <tr>
                <td>Mon animation</td>
                <td>OK</td>
            </tr>
            <tr>
                <td>Mes photos</td>
                <td>OK</td>
            </tr>
            <tr>
                <td>Mon repas</td>
                <td>Non défini</td>
            </tr>
            <tr>
                <td>Ma liste d'invités</td>
                <td>En cours</td>
            </tr>
        </table>
    </section>
</main>