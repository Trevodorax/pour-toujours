<?php
    session_start();
    require "includes/PHPMailer/PHPMailerAutoload.php";
    include('includes/db.php');

    $q = 'SELECT cle FROM PERSONNE WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute(array($_SESSION['email']));
    $key = $req->fetch();

    function smtpmailer($to, $from, $from_name, $subject, $body){
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';
        $mail->IsSMTP();
        $mail->SMTPAuth = true;

        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'pour.toujours2k22@gmail.com';
        $mail->Password = 'Respons11!!!';

        //   $path = 'reseller.pdf';
        //   $mail->AddAttachment($path);

        $mail->IsHTML(true);
        $mail->From="pour.toujours2k22@gmail.com";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $error ="Une erreur est survenue, merci de réessayer plus tard";
            return $error;
        }
        else
        {
            $error = "L'Email à bien été envoyé";
            return $error;
        }
    }

    $to   = htmlspecialchars($_SESSION['email']);
    $from = 'pour.toujours2k22@gmail.com';
    $name = 'Pour Toujours';
    $subj = 'Modification de votre mot de passe - Pour Toujours';
    $msg = ' <h3>Bonjour ' . htmlspecialchars($_SESSION["nomcomplet"]) . ' !</h3><br>,
                    
                    <p>Votre demande de changement de mot de passe a bien été enregistrée. Pour confirmer la modification de votre mot de passe, veuillez cliquer sur le lien ci-dessous :<br>
                    
                    <a href="http://localhost/pour-toujours/change_password.php?email=' . $to . '&cle=' . $key[0] . '" target="_blank">Modifier mon mot de passe</a><br><br>
                    
                    Si vous rencontrez des difficultés pour vous connecter à votre compte, contactez-nous via l\'adresse mail ' . $from . ' ou via le formulaire de contact de notre site.<br><br>
                    
                    Cordialement,<br>
                    L’équipe de <strong>Pour Toujours</strong></p>';

    $error=smtpmailer($to,$from, $name ,$subj, $msg);

    header('location: ' . $_SERVER['HTTP_REFERER'] . '?message=Un email vous a été envoyé');
    exit;