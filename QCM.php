<?php session_start() ;

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
        <title>QCM - Pour Toujours</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="style/QCM.css">
        <link rel="stylesheet" href="style/colors.css">
    </head>
    <body class="<?php echo wasDark() ? 'darkmode' : 'lightmode' ; ?>">
        <main>
            <form action="save_QCM.php" method="post">
                    <?php
                        function write_QCM_question($field_name, $question, $choices, $index){
                            echo "\n";
                            echo "<div class='form-question'>";
                                echo "<h2>Question $index/9</h2>";
                                echo "<p>" . $question . "</p>";

                                for($i = 0; $i < count($choices); $i++){
                                    echo "<div>";
                                        echo "<input type='radio' name='$field_name' value='" . $i . "'>";
                                        echo "<span onclick='checkButton(this)'>$choices[$i]</span>";
                                    echo "</div>";
                                }

                                echo "<div class='form-navigation'>";
                                    if($index != 1){
                                        echo "<a class='btn btn-primary' onclick='change_form($index, false)'>&lt-- précédent</a>";
                                    }else{
                                        echo "<a></a>";
                                    }
                                    if($index != 9){ // number of questions created
                                        echo "<a class='btn btn-primary' onclick='change_form($index, true)'>suivant --&gt</a>";
                                    }else{
                                        echo "<input class='btn btn-success' type='submit'>";
                                    }
                                echo "</div>";
                            echo "</div>";
                        }

                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 1);
                        write_QCM_question("assistance", "Vous préférez un accompagnement :", ["Très poussé, vous suivant du début à la fin", "Modéré, on vous aidera simplement à trouver des prestataires", "Minimal, vous aurez accès à notre liste de prestataires", "Aucun, vous venez juste pour voir"], 2);
                        write_QCM_question("budget", "Votre fourchette de budget est :", ["2000 - 6000 €", "6000 - 10000 €", "10000 - 14000 €", "Plus de 14000 €"], 3);
                        write_QCM_question("nourriture", "Pour vous, la nourriture est : ", ["Très importante", "Importante", "Peu importante", "Pas importante"], 4);
                        write_QCM_question("animation", "Pour vous, l'animation est : ", ["Très importante", "Importante", "Peu importante", "Pas importante"], 5);
                        write_QCM_question("lieu", "Pour vous, le lieu est : ", ["Très important", "Important", "Peu important", "Pas important"], 6);
                        write_QCM_question("tenue", "Pour vous, les tenues sont :", ["Très importantes", "Importantes", "Peu importantes", "Pas importantes"], 7);
                        write_QCM_question("photos", "Pour vous, les photos sont :", ["Très importantes", "Importantes", "Peu importantes", "Pas importantes"], 8);
                        write_QCM_question("nb_invites", "Choisissez une fourchette de nombre d'invités :", ["0 - 20", "20 - 50", "50 - 100", "100 - plus"], 9);
                        // modifier la ligne 42 en cas d'ajout de questions
                    ?>
                </div>

            </form>
        </main>
        <script src="scripts/QCM.js"></script>
    </body>
</html>
