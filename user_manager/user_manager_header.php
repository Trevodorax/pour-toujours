<?php 
    function wasDark(){
        if (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'darkmode'){
            return true ;
        }
    }   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Pour Toujours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/user_manager.css">
    <link rel="stylesheet" href="../style/colors.css">
</head>
<body class="<?php echo wasDark() ? 'darkmode' : 'lightmode' ; ?>">
    <header>
        <h2>Panneau de contrôle</h2>
        <nav>
            <a href="../index.php" class="btn btn-secondary">Retour à l'accueil</a>
            <a href="manage_users.php" class="btn btn-primary">Tous les utilisateurs</a>
        </nav>
    </header>
