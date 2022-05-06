

<main id="messages-main">
    <section id="mobile-control-nav">
        
        <!-- The nav is readable only if the user is a customer -->
        <!-- Service providers only have access to the message page of the control pannel -->
        
        <p id="nav-opener" class="<?php echo isCustomer()? '' : 'pouf' ?>">Mon panneau de contrôle</p>
        <nav class="<?php echo isCustomer()? '' : 'pouf' ?>">
            <br>
            <a href="control_pannel.php?page=home">Vue générale sur mon mariage</a>
            <a href="control_pannel.php?page=messages">Mes messages privés</a>
            <a href="control_pannel.php?page=grid&type=lieu">Mon lieu de mariage</a>
            <a href="control_pannel.php?page=grid&type=animation">Mon animation</a>
            <a href="control_pannel.php?page=grid&type=photos">Mes photos</a>
            <a href="control_pannel.php?page=grid&type=repas">Mon repas</a>
            <a href="control_pannel.php?page=grid&type=tenue">Ma tenue</a>
            <a href="control_pannel.php?page=favoris">Ma liste d'invités</a>
            <a href="control_pannel.php?page=invites">Mes favoris</a>
            <a href="settings.php">Mes paramètres</a>
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
                $q = 'SELECT id, personne1, personne2 FROM CONVERSATION WHERE personne1 = :id OR personne2 = :id ORDER BY dernier_message DESC ';
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

                        $q = 'SELECT email, nomprefere FROM PERSONNE WHERE id = :id';
                        $req = $bdd->prepare($q);
                        $req->execute([
                            'id' => $id_destinataire
                        ]);
                        $destinataires = $req->fetchAll();

                            echo '  <a href="control_pannel.php?page=messages&destinataire=' . $destinataires[0][0] .'">
                                                <img src="images/message_pfp.jpg">
                                                <div><span>' . $destinataires[0][1] .'</span> - ' . $destinataires[0][0] .'<br></div>
                                            </a>';
                    }
                }
            ?>
            <a href="control_pannel.php?page=messages&destinataire=pour-toujours">
                <img src="images/message_pfp.jpg">
                <div><span>L'équipe Pour-Toujours</span></div>
            </a>
        </section>
        <section id="conversation">
            <?php
                if (isset($_GET['destinataire']) && !empty($_GET['destinataire'])){
                    $email_destinataire = htmlspecialchars($_GET['destinataire']);

                    if ($email_destinataire == "pour-toujours"){
                        echo '<div class="from">Bonjour voisin !<br>Toute l\'équipe de Pour Toujours vous souhaites la bienvenue sur notre plateforme<br>Nous espérons de tout coeur que vous trouverez votre bonheur !<br>A bientôt !</br>L\'équipe Pour Toujours</div>';
                    }else{
                        if(isset($email_destinataire) && !empty($email_destinataire)) {
                            $q = 'SELECT id, email FROM personne WHERE email = :email';
                            $req = $bdd->prepare($q);
                            $req->execute([
                                'email' => $email_destinataire
                            ]);
                            $destinataire = $req->fetchAll();

                            if (count($destinataire) == 0) {
                                header('location: control_pannel.php?page=messages&message=Aucun utilisateur trouvé');
                                exit;
                            }

                            if ($email_destinataire != $destinataire[0][1]) {
                                header('location: control_pannel.php?page=messages&message=L\'email ne correspond a aucun utilisateur');
                                exit;
                            }

                            $q = 'SELECT id FROM CONVERSATION WHERE (personne1 = ? AND personne2 = ?) OR (personne1 = ? AND personne2 = ?)';
                            $req = $bdd->prepare($q);
                            $req->execute([
                                $destinataire[0][0],
                                $_SESSION['id'],
                                $_SESSION['id'],
                                $destinataire[0][0]
                            ]);
                            $conversation = $req->fetchAll();

                            if (count($conversations) != 0) {
                                $q = 'SELECT contenu, id_auteur FROM MESSAGE WHERE conversation = :conversation';
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
                    }
                }
            ?>

        </section>
    </div>
</main>
<script src="scripts/messages.js"></script>