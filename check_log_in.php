<?php

    //Writing the log
    function writeLogLine(bool $sucess, string $email){
    	$file = 'log.txt';
    	$value = $sucess? 'réussie' : 'échouée';
    	$log = fopen('log.txt' , 'a+');
    	$line = date('Y/m/d - H:i:s') . ' Tentative de connexion ' . $value . ' de :' . $email . "\n";
    	fputs($log, $line);
    	fclose($log);
    }


    include('includes/db.php');

    if(!isset($_POST['email']) || empty($_POST['email'])){
        header('location: log_in.php?message=Vous devez remplir le champ e-mail');
        exit;
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('location: log_in.php?message=Email invalide');
        exit;
    }

    if(!isset($_POST['password']) || empty($_POST['password'])){
        header('location: log_in.php?message=Vous devez remplir le champ mot de passe');
        exit;
    }

    $q = 'SELECT id, nomprefere, nomcomplet, departement FROM personne WHERE email = :email AND mot_de_passe = :password';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $_POST['email'],
        'password' => hash('sha512', $_POST['password'])
    ]);
    $id = $req->fetchAll();
    if(count($id) == 0){
        header('location: log_in.php?message=Identifiants incorrects');
        exit;
    }

    $q = 'SELECT emailPro FROM prestataire WHERE personne = :personne';
    $req = $bdd->prepare($q);
    $req->execute([
        'personne' => $id[0][0]
    ]);
    $emailpro = $req->fetchAll(PDO::FETCH_ASSOC);

    session_start();
    $_SESSION['id'] = $id[0][0];
    $_SESSION['nomprefere'] = $id[0][1];
    $_SESSION['nomcomplet'] = $id[0][2];
    $_SESSION['departement'] = $id[0][3];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['emailPro'] = $emailpro;
    header('location: index.php?message=Connecté avec succès');
    writeLogLine(true, $_POST['email']);
    exit;

?>
