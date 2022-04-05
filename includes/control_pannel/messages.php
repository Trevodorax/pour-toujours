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

            ?>
            <form method="post" action="">
                <input id="page-bottom" type="text" name="message" placeholder=" Votre message">
            </form>
            <?php
                $q = 'SELECT id FROM conversation WHERE personne1 = :id OR personne2 = :id';
                $req = $bdd->prepare($q);
                $req->execute([
                    'id' => $_SESSION['id']
                ]);
                $conversation = $req->fetchAll();

                $message = $_POST['message'];
                var_dump($_POST['message']);
                $q = "INSERT INTO message (contenu, conversation) VALUES (:contenu, :conversation)";
                $req = $bdd->prepare($q);
                $results = $req->execute([
                    'contenu' => $message,
                    'conversation' => $conversation[0][0]
                ]);
            ?>
        </section>
        <section id="messages-list">
            <button class="btn btn-primary" formmethod="post" formaction="" name="newconversation">Créer une nouvelle conversation</button>
            <form method="post" action="">
                <input type="email" name="email">
                <input type="submit">
            </form>
            <?php
                $q = 'SELECT id FROM personne WHERE email = :email';
                $req = $bdd->prepare($q);
                $req->execute([
                    'email' => $_POST['email']
                ]);
                $id2 = $req->fetchAll();

                if(count($id2) == 0){

                }

                $q = "INSERT INTO conversation (personne1, personne2) VALUES (:personne1, :personne2)";
                $req = $bdd->prepare($q);
                $results = $req->execute([
                    'personne1' => $_SESSION['id'],
                    'personne2' => $id2[0][0]
                ]);
            ?>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
            <a>
                <img src="images/message_pfp.jpg">
                <div><span>&nbspPour Toujours</span> - l'équipe<br>1 nouveau message</div>
            </a>
        </section>
        
    </div>
</main>
