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
            <form>
                    <?php
                        function write_QCM_question($field_name, $question, $choices, $index){
                            echo "<div class='form-question'>";
                                echo "<h2>Question $index/10</h2>";
                                echo "<p>" . $question . "</p>";

                                foreach($choices as $choice){
                                    echo "<div>";
                                        echo "<input type='radio' name='$field_name'>";
                                        echo "<span>$choice</span>";
                                    echo "</div>";
                                }

                                echo "<div class='form-navigation'>";
                                    if($index != 1){
                                        echo "<a onclick='change_form($index, false)'>&lt-- précédent</a>";
                                    }else{
                                        echo "<a></a>";
                                    }
                                    if($index != 10){
                                        echo "<a onclick='change_form($index, true)'>suivant --&gt</a>";
                                    }else{
                                        echo "<a><input type='submit'></a>";
                                    }
                                echo "</div>";
                            echo "</div>";
                        }

                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 1);
                        write_QCM_question("budget", "Votre fourchette de budget est :", ["500 - 1000 €", "1000 - 2000 €", "2000 - 3000 €", "3000 € ou plus"], 2);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 3);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 4);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 5);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 6);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 7);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 8);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 9);
                        write_QCM_question("religion", "Vous planifiez un mariage :", ["Civil", "Religieux", "Mixte", "Peu importe"], 10);
                    ?>
                </div>

            </form>
        </main>
        <script src="scripts/QCM.js"></script>
    </body>
</html>
