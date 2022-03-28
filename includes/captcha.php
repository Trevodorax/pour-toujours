<link rel="stylesheet" href="style/captcha.css">

<div id="captcha">
    <?php
        for($i = 1; $i < 10; $i++){
            echo "<img id='captcha$i' src='images/captcha/captcha$i.jpg'>";
        }
    ?>
</div>

<script src="scripts/captcha.css"></script>
