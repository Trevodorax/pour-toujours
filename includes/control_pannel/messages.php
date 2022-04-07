<main id="messages-main">
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
            <a href="#">Ma liste d'invités</a>
            <a href="#">Mes favoris</a>
            <a href="#">Mes paramètres</a>
        </nav>
    </section>
    <h2>Mes messages privés</h2>
    <div class="message-page-content">
        <section id="conversation">
            <div class="from">Bienvenue Paul ! Toute l'équipe de PourToujours te souhaite  un mariage heureux. </div>
            <div class="to">Merci à vous tous, mon ame-soeur, Simon, et moi-même sommes aux anges depuis que nous avons découverts votre site ! Vous êtes des génies.</div>
            <div class="from">Vous n'avez encore rien vu.</div>
            <div class="from">Bienvenue Paul ! Toute l'équipe de PourToujours te souhaite  un mariage heureux. </div>
            <div class="to">Merci à vous tous, mon ame-soeur, Simon, et moi-même sommes aux anges depuis que nous avons découverts votre site ! Vous êtes des génies.</div>
            <div class="from">Vous n'avez encore rien vu.</div>
            <div class="from">Bienvenue Paul ! Toute l'équipe de PourToujours te souhaite  un mariage heureux. </div>
            <div class="to">Merci à vous tous, mon ame-soeur, Simon, et moi-même sommes aux anges depuis que nous avons découverts votre site ! Vous êtes des génies.</div>
            <div class="from">Vous n'avez encore rien vu !</div>
            <?php
                $q = 'SELECT id FROM conversation WHERE ' . $_SESSION['id'] . ' = personne1 OR ' . $_SESSION['id'] . ' = personne2';
                $req = $bdd->prepare($q);
                $req->execute([

                ]);
                $id_conversation = $req->fetchAll();

                $q = 'SELECT contenu FROM message WHERE conversation = ' . $id_conversation[0][0];
                $req = $bdd->prepare($q);
                $req->execute([
                ]);
                $message = $req->fetchAll();

                foreach ($message as $key => $value){
                    echo '<p>' . $message[0][0] .'</p>';
                }
            ?>
            <form method="post" action="new_message.php">
                <input id="page-bottom" type="text" name="message" placeholder=" Votre message">
            </form>
        </section>
        <section id="messages-list">
            <button id="new-conv-form-appear" class="btn btn-primary" formmethod="post" formaction="" name="newconversation">Créer une nouvelle conversation</button>
            <form id="new-conv-form" class="pouf" method="post" action="new_conversation.php">
                <input type="email" name="email">
                <input type="submit">
            </form>

            <?php

                ?>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
        </section>
        
    </div>
</main>
<script src="scripts/messages.js"></script>