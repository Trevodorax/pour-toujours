<?php

    require "includes/PHPMailer/PHPMailerAutoload.php";

    include('includes/db.php');

    // checking if inputs are set and not empty
    if(!isset($_POST['c_name']) || empty($_POST['c_name'])){
        header('location: create_account.php?message=Vous devez remplir le champ nom complet');
        exit;
    }

    if(isset($_POST['c_name']) && !empty($_POST['c_name'])){
        setcookie('nomcomplet', $_POST['c_name'], time() + 24 * 60 * 60);
    }

    if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
        header('location: create_account.php?message=Vous devez remplir le champ nom préféré');
        exit;
    }

    if(isset($_POST['f_name']) && !empty($_POST['f_name'])){
        setcookie('nomprefere', $_POST['f_name'], time() + 24 * 60 * 60);
    }

    if(!isset($_POST['b_date']) || empty($_POST['b_date'])){
        header('location: create_account.php?message=Vous devez entrer votre date de naissance');
        exit;
    }

    if(isset($_POST['b_date']) && !empty($_POST['b_date'])){
        setcookie('date_naissance', $_POST['b_date'], time() + 24 * 60 * 60);
    }

    $b_date = htmlspecialchars($_POST['b_date']);

    $array = explode('-', $b_date);
    $year = $array[0];
    $month = $array[1];
    $day = $array[2];

    if(checkdate($year, $month, $day)){
        header('location: create_account.php?message=La date entrée n\'est pas valide');
        exit;
    }

    if(!isset($_POST['departement']) || empty($_POST['departement'])){
        header('location: create_account.php?message=Vous devez sélectionner un département');
        exit;
    }

    // processing departement
    $departement = htmlspecialchars($_POST['departement']);

    $departement_name = explode('-', $departement);
    $departement_number = $departement_name[0];

    $departement = $departement_number;

    // check if phone number already exists
    $q = 'SELECT id FROM personne WHERE numero_tel = :tel';
    $req = $bdd->prepare($q);
    $req->execute([
        'tel' => htmlspecialchars($_POST['tel'])
    ]);
    $email = $req->fetchAll();

    if(count($email) != 0){
        header ('location: create_account.php?message=Le numéro de téléphone est déjà utilisé');
        exit;
    }

    // checking if phone number exists and is defined
    if(!isset($_POST['tel']) || empty($_POST['tel'])){
        header('location: create_account.php?message=Vous devez remplir le champ numéro de téléphone');
        exit;
    }

    if (!preg_match('#^0[1678]([ \-\.]?[0-9]{2}){4}$#', $_POST['tel'])){
        header('location: create_account.php?message=Le numéro de téléphone n\'est pas valide');
        exit;
    }

    if(isset($_POST['tel']) && !empty($_POST['tel'])){
        setcookie('numero_tel', $_POST['tel'], time() + 24 * 60 * 60);
    }

    // checking if email already exists
    $q = 'SELECT id FROM personne WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => htmlspecialchars($_POST['email'])
    ]);
    $email = $req->fetchAll();
    if(count($email) != 0){
        header ('location: create_account.php?message=L\'email est déjà utilisé');
        exit;
    }

    // checking if email is correctly filled
    if(!isset($_POST['email']) || empty($_POST['email'])){
        header('location: create_account.php?message=Vous devez remplir le champ email');
        exit;
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('location: create_account.php?message=Email invalide');
        exit;
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
        setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
    }


    // password checks
    if(!isset($_POST['password']) || empty($_POST['password'])){
        header('location: create_account.php?message=Vous devez remplir le champ mot de passe');
        exit;
    }

    if(strlen($_POST['password']) < 8){
        header('location: create_account.php?message=Le mot de passe doit contenir 8 caractères minimum');
        exit;
    }

    if (!preg_match('#^(?=.*[A-Z])#', $_POST['password'])){
        header('location: create_account.php?message=Le mot de passe doit contenir une majuscule');
        exit;
    }

    if (!preg_match('#^(?=.*[a-z])#', $_POST['password'])){
        header('location: create_account.php?message=Le mot de passe doit contenir une minuscule');
        exit;
    }

    if (!preg_match('#^(?=.*\d)#', $_POST['password'])){
        header('location: create_account.php?message=Le mot de passe doit contenir un chiffre');
        exit;
    }

    if (!preg_match('#^(?=.*\W)#', $_POST['password'])){
        header('location: create_account.php?message=Le mot de passe doit contenir un caractère spécial');
        exit;
    }

    if(!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])){
        header('location: create_account.php?message=Vous devez confirmer votre mot de passe');
        exit;
    }

    if ($_POST['password'] != $_POST['confirm_password']){
        header('location: create_account.php?message=Les mots de passe ne correspondent pas');
        exit;
    }

    // checking and putting gender in the right format for db
    if(!isset($_POST['genre']) || empty($_POST['genre'])){
        header('location: create_account.php?message=Vous devez sélectionner un genre');
        exit;
    }

    if(htmlspecialchars($_POST['genre']) === "Homme"){
        $genre = "H";
    }elseif (htmlspecialchars($_POST['genre']) === "Femme"){
        $genre = "F";
    }elseif (htmlspecialchars($_POST['genre']) === "Autre"){
        $genre = "A";
    }elseif(htmlspecialchars($_POST['genre']) === "Préfère ne pas répondre"){
        $genre = "N";
    }

    $key = rand(100000000, 999999999);

    // creating a new person if everything looks nice
    $q = "INSERT INTO personne(nomComplet, nomPrefere, date_naissance, genre, email, mot_de_passe, numero_tel, departement, cle) VALUES (:c_name, :f_name, :b_date, :genre, :email, :password, :tel, :departement, :cle)";
    $req = $bdd->prepare($q);
    $personne = $req->execute([
        'c_name' => htmlspecialchars($_POST['c_name']),
        'f_name' => htmlspecialchars($_POST['f_name']),
        'b_date' => htmlspecialchars($_POST['b_date']),
        'genre' => $genre,
        'email' => htmlspecialchars($_POST['email']),
        'password' => hash('sha512', htmlspecialchars($_POST['password'])),
        'tel' => htmlspecialchars($_POST['tel']),
        'departement' => $departement,
        'cle' => $key
    ]);

    // checking if personne has been successfully created
    if (!$personne){
        header('location: create_account.php?message=Erreur lors de l\'inscription');
        exit;
    }

    // getting the ID of the person we just created
    $q = 'SELECT id FROM personne WHERE email = :email';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => htmlspecialchars($_POST['email'])
    ]);
    $id = $req->fetchAll();

    // in that block, a pro is created
    if(isset($_POST['pro_access'])){
        // chekcing pro inputs
        if(!isset($_POST['company_name']) || empty($_POST['company_name'])){
            header('location: create_account.php?message=Vous devez remplir le champ nom de votre entreprise');
            exit;
        }

        if(isset($_POST['company_name']) && !empty($_POST['company_name'])){
            setcookie('nomentreprise', $_POST['company_name'], time() + 24 * 60 * 60);
        }

        // checking if phone number is good
        $q = 'SELECT id FROM prestataire WHERE telpro = :telpro';
        $req = $bdd->prepare($q);
        $req->execute([
            'telpro' => htmlspecialchars($_POST['tel_pro'])
        ]);
        $email = $req->fetchAll();
        if(count($email) != 0){
            header ('location: create_account.php?message=Le numéro de téléphone est déjà utilisé');
            exit;
        }

        if(!isset($_POST['tel_pro']) || empty($_POST['tel_pro'])){
            header('location: create_account.php?message=Vous devez remplir le champ numéro de téléphone');
            exit;
        }

        if (!preg_match('#^0[136789]([ \-\.]?[0-9]{2}){4}$#', $_POST['tel_pro'])){
            header('location: create_account.php?message=Le numéro de téléphone n\'est pas valide');
            exit;
        }

        if(isset($_POST['tel_pro']) && !empty($_POST['tel_pro'])){
            setcookie('telpro', $_POST['tel_pro'], time() + 24 * 60 * 60);
        }

        // checking if email is correct
        $q = 'SELECT id FROM prestataire WHERE emailpro = :emailpro';
        $req = $bdd->prepare($q);
        $req->execute([
            'emailpro' => htmlspecialchars($_POST['email_pro'])
        ]);
        $email = $req->fetchAll();
        if(count($email) != 0){
            header ('location: create_account.php?message=L\'email est déjà utilisé');
            exit;
        }

        if(!isset($_POST['email_pro']) || empty($_POST['email_pro'])){
            header('location: create_account.php?message=Vous devez remplir le champ email professionnel');
            exit;
        }

        if(!filter_var($_POST['email_pro'], FILTER_VALIDATE_EMAIL)){
            header('location: create_account.php?message=Email invalide');
            exit;
        }

        if(isset($_POST['email_pro']) && !empty($_POST['email_pro'])){
            setcookie('emailpro', $_POST['email_pro'], time() + 24 * 60 * 60);
        }

        // checking if other things are valid
        if(!isset($_POST['activite']) || empty($_POST['activite'])){
            header("location: create_account.php?message=Vous devez sélectionner un secteur d'activité");
            exit;
        }

        // checking if a link exists
        if(!isset($_POST['site']) || empty($_POST['site'])){
            //if no
            header("location: create_account.php?message=Vous devez entrer le lien de votre site");
            exit;
        }else{
            // if yes
            $link = htmlspecialchars($_POST['site']);
            // checking if there's a protocol, if not adding one
            $temp_link = (!preg_match('#^(ht|f)tps?://#', $link)) ? 'http://' . $link : $link;
            //checking if it's a valid url
            if (filter_var($temp_link, FILTER_VALIDATE_URL)){
                $link = $temp_link;
            } else {
                header("location: create_account.php?message=Le lien de votre site n'est pas valide");
                exit;
            }
        }

        if(isset($_POST['site']) && !empty($_POST['site'])){
            setcookie('liensiteweb', $_POST['site'], time() + 24 * 60 * 60);
        }

        // checking image validity
        if($_FILES['image']['error'] != 4){

            $ext = [
                'image/jpg',
                'image/jpeg',
                'image/gif',
                'image/png'
            ];

            if(!in_array($_FILES['image']['type'], $ext)){
                header ('location: create_account.php?message=Format d\'image incorrect');
                exit;
            }

            $maxSize = 4 * 1024 * 1024;

            if($_FILES['image']['size'] > $maxSize){
                header('location: create_account.php?message=L\'image ne doit pas dépasser 4 Mo');
                exit;
            }

            // putting the image in the right folder
            $path = 'images/prestataires';
            if(!file_exists($path)){
                mkdir($path, 0777,true);
                // the third parameter, allows the creation of a recursive $path
            }

            $filename = htmlspecialchars($_FILES['image']['name']);

            $array = explode('.', $filename);
            $extension = end($array);

            $filename = 'image-' . time() . '.' . $extension;

            $destination = $path . '/' . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        }

        // creating a new presta linked to this personne
        $q = "INSERT INTO prestataire (nomEntreprise, telpro, emailpro, metier, photoProfil, lienSiteWeb, personne) VALUES (:companyname, :telpro, :emailpro, :metier, :profilepicture, :linkwebsite, :personne)";
        $req = $bdd->prepare($q);
        $prestataire = $req->execute([
            'companyname' => htmlspecialchars($_POST['company_name']),
            'telpro' => htmlspecialchars($_POST['tel_pro']),
            'emailpro' => htmlspecialchars($_POST['email_pro']),
            'metier' => htmlspecialchars($_POST['activite']),
            'profilepicture' => $filename,
            'linkwebsite' => $link,
            'personne' => $id[0][0]
        ]);

        if (!$prestataire){
            $q = 'DELETE FROM personne WHERE id = ' . $id;
            $req = $bdd->prepare($q);
            $result = $req->execute();
            header('location: create_account.php?message=Erreur lors de l\'inscription');
            exit;
        }

    }else{
        // creating a new user linked to this personne
        $q = "INSERT INTO utilisateur (personne) VALUES(:idPersonne)";
        $req = $bdd->prepare($q);
        $utilisateur = $req->execute([
            'idPersonne' => $id[0][0]
        ]);

        if (!$utilisateur){
            header('location: create_account.php?message=Erreur lors de l\'inscription');
            exit;
        }
    }

    // checking if the account was created
    if($personne){

        // if yes, sending an email
        function smtpmailer($to, $from, $from_name, $subject, $body){
            $mail = new PHPMailer();
            $mail->CharSet = "UTF-8";
            $mail->Encoding = 'base64';
            $mail->IsSMTP();
            $mail->SMTPAuth = true;

            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = 'pour.toujours2k22@gmail.com';
            $mail->Password = 'Respons11!!!';

            //   $path = 'reseller.pdf';
            //   $mail->AddAttachment($path);

            $mail->IsHTML(true);
            $mail->From="pour.toujours2k22@gmail.com";
            $mail->FromName=$from_name;
            $mail->Sender=$from;
            $mail->AddReplyTo($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($to);
            if(!$mail->Send())
            {
                $error ="Une erreur est survenue, merci de réessayer plus tard";
                return $error;
            }
            else
            {
                $error = "L'Email à bien été envoyé";
                return $error;
            }
        }

        $to   = htmlspecialchars($_POST['email']);
        $from = 'pour.toujours2k22@gmail.com';
        $name = 'Pour Toujours';
        $subj = 'Confirmation de votre compte - Pour Toujours';
        $msg = ' <h3>Bonjour ' . htmlspecialchars($_POST["c_name"]) . ' !</h3><br>,
                
                <p>Merci d’avoir rejoint Pour Toujours.<br><br>
                
                Votre demande de création de compte a bien été enregistrée. Pour confirmer la création de votre compte, veuillez cliquer sur le lien ci-dessous :<br>
                
                <a href="http://localhost/pour-toujours/confirm_sign_up.php?email=' . $to . '&cle=' . $key . '" target="_blank">Confirmer mon compte</a><br><br>
                
                Si vous rencontrez des difficultés pour vous connecter à votre compte, contactez-nous via l\'adresse mail ' . $from . ' ou via le formulaire de contact de notre site.<br><br>
                
                Cordialement,<br>
                L’équipe de <strong>Pour Toujours</strong></p>';

        $error=smtpmailer($to,$from, $name ,$subj, $msg);

        header('location: index.php?message=Compte créé avec succès');
        exit;
    }
    else{
        header('location: create_account.php?message=Erreur lors de l\'inscription');
        exit;
    }

?>
