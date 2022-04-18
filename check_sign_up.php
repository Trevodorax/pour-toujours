<?php

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

    if(!isset($_POST['departement']) || empty($_POST['departement'])){
        header('location: create_account.php?message=Vous devez sélectionner un département');
        exit;
    }

    // processing departement
    $departement = $_POST['departement'];

    $departement_name = explode('-', $departement);
    $departement_number = $departement_name[0];

    $departement = $departement_number;

    // check if phone number already exists
    $q = 'SELECT id FROM personne WHERE numero_tel = :tel';
    $req = $bdd->prepare($q);
    $req->execute([
        'tel' => $_POST['tel']
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
        'email' => $_POST['email']
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

    if($_POST['genre'] === "Homme"){
        $genre = "H";
    }elseif ($_POST['genre'] === "Femme"){
        $genre = "F";
    }elseif ($_POST['genre'] === "Autre"){
        $genre = "A";
    }elseif($_POST['genre'] === "Préfère ne pas répondre"){
        $genre = "N";
    }

    // creating a new person if everything looks nice
    $q = "INSERT INTO personne(nomComplet, nomPrefere, date_naissance, genre, email, mot_de_passe, numero_tel, departement) VALUES (:c_name, :f_name, :b_date, :genre, :email, :password, :tel, :departement)";
    $req = $bdd->prepare($q);
    $personne = $req->execute([
        'c_name' => $_POST['c_name'],
        'f_name' => $_POST['f_name'],
        'b_date' => $_POST['b_date'],
        'genre' => $genre,
        'email' => $_POST['email'],
        'password' => hash('sha512', $_POST['password']),
        'tel' => $_POST['tel'],
        'departement' => $departement
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
        'email' => $_POST['email']
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
            'telpro' => $_POST['tel_pro']
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

        if (!preg_match('#^0[168]([ \-\.]?[0-9]{2}){4}$#', $_POST['tel_pro'])){
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
            'emailpro' => $_POST['email_pro']
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

        if(!isset($_POST['site']) || empty($_POST['site'])){
            $link = "*";
        }else{
            $link = $_POST['site'];
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

            $filename = $_FILES['image']['name'];

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
            'companyname' => $_POST['company_name'],
            'telpro' => $_POST['tel_pro'],
            'emailpro' => $_POST['email_pro'],
            'metier' => $_POST['activite'],
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
        header('location: index.php?message=Compte créé avec succès');
        exit;
    }
    else{
        header('location: create_account.php?message=Erreur lors de l\'inscription');
        exit;
    }

?>
