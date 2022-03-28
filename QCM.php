<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>QCM - Pour Toujours</title>
        <link rel="stylesheet" href="style/QCM.css">
    </head>
    <body>
        <main>
            <h2>Question 1/10</h2>
            <form>
                <p>Vous planifiez un mariage :</p>
                <div>
                    <input type="radio" name="type">
                    <span>Civil</span>
                </div>
                <div>
                    <input type="radio" name="type">
                    <span>Religieux</span>
                </div>
                <div>
                    <input type="radio" name="type">
                    <span>Mixte</span>
                </div>
                <div>
                    <input type="radio" name="type">
                    <span>Peu importe</span>
                </div>
                <div class="form-navigation">
                    <a onclick="change_form(1, false)">&lt-- précédent</a>
                    <a onclick="change_form(1, true)">Suivant --&gt</a>
                </div>
                
            </form>
            
        </main>
        <script src="scripts/QCM.js"></script>
    </body>
</html>
