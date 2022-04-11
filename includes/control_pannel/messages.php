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
        <section id="messages-list">
            <button id="new-conv-form-appear" class="btn btn-primary" formmethod="post" formaction="" name="newconversation">Créer une nouvelle conversation</button>
            <form id="new-conv-form" class="pouf" method="post" action="new_conversation.php">
                <input type="email" name="email">
                <input type="submit">
            </form>
            <?php
                $q = 'SELECT id, personne1, personne2 FROM conversation WHERE personne1 = :id OR personne2 = :id';
                $req = $bdd->prepare($q);
                $req->execute([
                    'id' => $_SESSION['id']
                ]);
                $conversations = $req->fetchAll();

                if(count($conversations) != 0){
                    foreach ($conversations as $key => $value) {
                        if ($conversations[$key][1] == $_SESSION['id']){
                            $id_destinataire = $conversations[$key][2];
                        }else{
                            $id_destinataire = $conversations[$key][1];
                        }

                        $q = 'SELECT email, nomprefere FROM personne WHERE id = :id';
                        $req = $bdd->prepare($q);
                        $req->execute([
                            'id' => $id_destinataire
                        ]);
                        $destinataires = $req->fetchAll();

                            echo '  <a href="control_pannel.php?page=messages&destinataire=' . $destinataires[0][0] .'">
                                                <img src="images/message_pfp.jpg">
                                                <div><span>' . $destinataires[0][1] .'</span> - ' . $destinataires[0][0] .'<br>1 nouveau message</div>
                                            </a>';
                    }
                }
            ?>
        </section>
        <section id="conversation">
            <?php
                if (isset($_GET['destinataire']) && !empty($_GET['destinataire'])){
                    $email_destinataire = htmlspecialchars($_GET['destinataire']);
                }

                if(isset($email_destinataire) && !empty($email_destinataire)) {
                    $q = 'SELECT id, email FROM personne WHERE email = :email';
                    $req = $bdd->prepare($q);
                    $req->execute([
                        'email' => $email_destinataire
                    ]);
                    $destinataire = $req->fetchAll();

                    /*if (count($destinataire) == 0) {
                        header('location: control_pannel.php?page=messages&message=Aucun utilisateur trouvé');
                        exit;
                    }*/

                    if ($email_destinataire != $destinataire[0][1]) {
                        header('location: control_pannel.php?page=messages&message=L\'email ne correspond a aucun utilisateur');
                        exit;
                    }

                    $q = 'SELECT id FROM conversation WHERE (personne1 = ? AND personne2 = ?) OR (personne1 = ? AND personne2 = ?)';
                    $req = $bdd->prepare($q);
                    $req->execute([
                        $destinataire[0][0],
                        $_SESSION['id'],
                        $_SESSION['id'],
                        $destinataire[0][0]
                    ]);
                    $conversation = $req->fetchAll();

                    if (count($conversations) != 0) {
                        $q = 'SELECT contenu, id_auteur FROM message WHERE conversation = :conversation';
                        $req = $bdd->prepare($q);
                        $req->execute([
                            'conversation' => $conversation[0][0]
                        ]);
                        $message = $req->fetchAll();

                        foreach ($message as $key => $value) {
                            if ($message[$key][1] == $_SESSION['id']) {
                                echo '<div class="to">' . $message[$key][0] . '</div>';
                            } else {
                                echo '<div class="from">' . $message[$key][0] . '</div>';
                            }
                        }
                        echo '<form method="post" action="new_message.php">
                                    <input id="page-bottom" type="text" name="message" placeholder=" Votre message">
                                    <input type="hidden" name="destinataire" value="' . $destinataire[0][0] .'">                            
                                </form>';
                    }
                }
            ?>

        </section>
    </div>
</main>
<script src="scripts/messages.js"></script>