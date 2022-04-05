<!DOCTYPE html>
<html>
    <head>
        <?php include('includes/common_head.php'); ?>
        <link rel="stylesheet" href="style/log_in.css">
    </head>
    <body>
        <?php include('includes/header.php'); ?>

        <main>
            <h2>Créer un compte</h2>
            <p>Accédez à votre profil en saisissant vos identifiants</p>
            <form method="post" action="check_log_in.php">

                <input type="email" name="email" class="required-input" placeholder=" Votre e-mail" required>
                <input type="password" name="password" class="required-input" placeholder=" Votre mot de passe" required>

                <?php 
                    if(isset($_GET['message']) && !empty($_GET['message'])) {

                        echo ' <p id="error-message">'. $_GET['message'] . '</p>';
                    }
                ?>
               
                <button id="validate-button" class="big-red-button no-click"><p>Me connecter</p></button>
                <p id="forgot_pwd">Mot de passe oublié ? <a href="#">Réinitializez-le.</a></p>

            </form>

            <div id="under-form">
                <p>Vous n'avez pas encore de compte ? <a href="create_account.php"> S'inscrire</a></p>
            </div>
        </main>

        <?php include('includes/footer.php'); ?>

        <script src="scripts/index.js"></script>
        <script src="scripts/log_in.js"></script>
    </body>
</html>
