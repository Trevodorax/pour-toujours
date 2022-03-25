<?php

    include('includes/db.php');

    if(!isset($_POST['c_name']) || empty($_POST['c_name'])){
        header('location: create_account.php?message=Vous devez remplir le champ nom complet');
        exit;
    }

    if(!isset($_POST['f_name']) || empty($_POST['f_name'])){
        header('location: create_account.php?message=Vous devez remplir le champ nom préféré');
        exit;
    }

    if(!isset($_POST['region']) || empty($_POST['region'])){
        header('location: create_account.php?message=Vous devez sélectionner une région');
        exit;
    }

    if(!isset($_POST['tel']) || empty($_POST['tel'])){
        header('location: create_account.php?message=Vous devez remplir le champ numéro de téléphone');
        exit;
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
        setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
    }

    if(!isset($_POST['email']) || empty($_POST['email'])){
        header('location: create_account.php?message=Vous devez remplir le champ email');
        exit;
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('location: create_account.php?message=Email invalide');
        exit;
    }

    if(!isset($_POST['password']) || empty($_POST['password'])){
        header('location: create_account.php?message=Vous devez remplir le champ mot de passe');
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

    if(!isset($_POST['genre']) || empty($_POST['genre'])){
        header('location: create_account.php?message=Vous devez sélectionner un genre');
        exit;
    }

    if(isset($_POST['pro_access'])){
        if(!isset($_POST['company_name']) || empty($_POST['company_name'])){
            header('location: create_account.php?message=Vous devez remplir le champ nom de votre entreprise');
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

        if(!isset($_POST['activite']) || empty($_POST['activite'])){
            header("location: create_account.php?message=Vous devez sélectionner un secteur d'activité");
            exit;
        }
    }

    $q = "INSERT INTO personne(`c_name`, `f_name`, `b_date`, `region`, `tel`, `email`, `password`, `genre`) VALUES (:c_name, :f_name, :b_date, :region, :tel, :email, :password, :genre)";
    $req = $bdd->prepare($q);

    $req = $bdd->prepare($q); // Requête préparée
    $result = $req->execute([
        'c_name' => $_POST['c_name'],
        'f_name' => $_POST['f_name'],
        'b_date' => $_POST['b_date'],
        'region' => $_POST['region'],
        'tel' => $_POST['tel'],
        'email' => $_POST['email'],
        'password' => hash('sha512', $_POST['password']),
        'genre' => $_POST['genre']
    ]);

$q = "INSERT INTO prestataire(`company_name`, `tel_pro`, `email_pro`,`metier`) VALUES (:company_name, :tel_pro, :email_pro, :activite, :tel, :email, :password, :genre)";
$req = $bdd->prepare($q);

$req = $bdd->prepare($q); // Requête préparée
$result = $req->execute([
    'company_name' => $_POST['company_name'],
    'tel_pro' => $_POST['tel_pro'],
    'email_pro' => $_POST['email_pro'],
    'metier' => $_POST['activite'],
]);
    /*
    if($result){
        // L'insertion a fonctionné
        header('location: connexion.php?message=Compte créé avec succès&type=success');
        exit;
    }
    else{
        // L'insertion n'a pas fonctionné
        header('location: inscription.php?message=Erreur lors de l\'inscription&type=danger');
        exit;
    }
    */
?>
