<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/create_account.css">
    </head>
    <body>
        <main>
            <h2>Modifier votre mot de passe</h2>
            <p>Saisissez vos informations pour continuer</p>
            <form method="post" action ="" enctype="multipart/form-data">
                <input type="password" name="previous" class="required-input" placeholder=" Votre ancien mot de passe" required>
                <input type="password" name="new" class="required-input" placeholder=" Votre nouveau mot de passe" required>
                <input type="password" name="new_confirm" class="required-input" placeholder=" Confirmez votre nouveau mot de passe" required>
                <input type="submit" id="validate-button" class="big-red-button" style="color: white;" value="Modifier mon mot de passe" name="submit">
            </form>
        </main>
    </body>
</html>
<?php
session_start();
include('includes/db.php');

if(isset($_POST['submit'])){

    if (!isset($_GET['email']) || empty($_GET['email']) || !isset($_GET['cle']) || empty($_GET['cle'])){
        header('location: index.php?message=Il manque les informations de vérifications');
        exit;
    }

    $email = htmlspecialchars($_GET['email']);
    $key = htmlspecialchars($_GET['cle']);

    // checking if fields are filled
    if(!isset($_POST['previous']) || empty($_POST['previous'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Vous devez remplir le champ ancien mot de passe');
        exit;
    }
    if(!isset($_POST['new']) || empty($_POST['new'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Vous devez remplir le champ nouveau mot de passe');
        exit;
    }
    if(!isset($_POST['new_confirm']) || empty($_POST['new_confirm'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Vous devez remplir le champ confirmation du nouveau mot de passe');
        exit;
    }

    if(strlen($_POST['new']) < 8){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Le nouveau mot de passe doit contenir 8 caractères minimum');
        exit;
    }

    if (!preg_match('#^(?=.*[A-Z])#', $_POST['new'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Le nouveau mot de passe doit contenir une majuscule');
        exit;
    }

    if (!preg_match('#^(?=.*[a-z])#', $_POST['new'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Le nouveau mot de passe doit contenir une minuscule');
        exit;
    }

    if (!preg_match('#^(?=.*\d)#', $_POST['new'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Le nouveau mot de passe doit contenir un chiffre');
        exit;
    }

    if (!preg_match('#^(?=.*\W)#', $_POST['new'])){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Le nouveau mot de passe doit contenir un caractère spécial');
        exit;
    }

    if ($_POST['new'] != $_POST['new_confirm']){
        header('location: ' . $_SERVER['HTTP_REFERER'] . '&message=Les nouveaux mots de passe ne correspondent pas');
        exit;
    }

    // checking if previous password matches

    $q = 'SELECT id FROM PERSONNE WHERE email = :email AND cle = :cle AND mot_de_passe = :password';
    $req = $bdd->prepare($q);
    $req->execute([
        'email' => $email,
        'cle' => $key,
        'password' => hash('sha512',htmlspecialchars($_POST['previous']))
    ]);
    $id = $req->fetchAll();
    if(count($id) == 0){
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&message=Identifiants incorrects');
        exit;
    }

    $q = 'UPDATE PERSONNE SET mot_de_passe = :newpassword WHERE email = :email AND mot_de_passe = :password';
    $req = $bdd->prepare($q);
    $req->execute([
        'newpassword' => hash('sha512',htmlspecialchars($_POST['new'])),
        'email' => $email,
        'password' => hash('sha512',htmlspecialchars($_POST['previous']))
    ]);

    header('Location: index.php?message=Mot de passe modifié avec succès');
    exit;
}
?>