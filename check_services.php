<?php
session_start();
include('includes/db.php');

//Need to do all the verifs from forms from pro_profile 

if (isset($_GET['pro']) && !empty($_GET['pro'])) {

    $id_presta = htmlspecialchars($_GET['pro']);

    if (isset($_GET['section']) && $_GET['section'] == "service"){

        
        //Cheking if services adding form is OK:

        if(!isset($_POST['title']) || empty($_POST['title'])
            || !isset($_POST['price']) || empty($_POST['price'])
                || !isset($_POST['description']) || empty($_POST['description'])
                ){
                    header('location: pro_profile.php?message=Vous devez remplir tous les champs');
                    exit;
                }

            if (!isset($_GET['type']) || empty($_GET['type']) ){
                header('location: pro_profile.php?message=Il y a eu un problème');
                exit;
            }
        
        $type =htmlspecialchars($_GET['type']);
        $letter = $type[0];


        $q ='INSERT INTO SERVICE(nom, type, tarif,description,prestataire) VALUES (:nom, :type, :tarif, :description, :prestataire)';
        $req = $bdd->prepare($q);
        $req -> execute([
            'nom' => htmlspecialchars($_POST['title']),
            'type' => $letter[0],
            'tarif' => htmlspecialchars($_POST['price']),
            'description' => htmlspecialchars($_POST['description']),
            'prestataire' => $id_presta
        
        ]);

    header('location: pro_profile.php?message=Service créé avec succès !');
    exit;

    }


    //Cheking if photos adding form is OK:
        // checking image validity
        if($_FILES['image']['error'] != 4 && isset($_POST['description']) && !empty($_POST['description'])){

            $ext = [
                'image/jpg',
                'image/jpeg',
                'image/gif',
                'image/png'
            ];

            if(!in_array($_FILES['image']['type'], $ext)){
                header ('location: pro_profile.php?message_photo=Format d\'image incorrect');
                exit;
            }

            $maxSize = 4 * 1024 * 1024;

            if($_FILES['image']['size'] > $maxSize){
                header('location: pro_profile.php?message_photo=L\'image ne doit pas dépasser 4 Mo');
                exit;
            }

            // Creating the image folder
            $path = 'images/portfolios/' . $id_presta;
            if(!file_exists($path)){
                mkdir($path, 0777, true);
                // the third parameter, allows the creation of a recursive $path
            }
    
            // We must save the photo into the server to transform it after.
            //saving the extension format for later
            $filename = $_FILES['image']['name'];
            $array = explode('.', $filename);   
            $extension = end($array);
            $filename = 'image-' . time() . '.' . $extension;
            $destination = $path . '/' . $filename; 
            move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            //ADDIND THE WATERMARK
            //
            //creating the file where the new photo will be saved
            $newFilename = $path . '/image-' . time() . '.' . $extension;

            //preparing the two photos we want to combine
            $image = imagecreatefrompng($destination);
            $stamp = imagecreatefrompng('images/logo.png');

            //taking the size of the logo pic
            $width_stamp = imagesx($stamp);
            $height_stamp = imagesy($stamp);

            // this function add a picture to another one with transparence
            imagecopymerge($image, $stamp, imagesx($image)/2, imagesy($image)/2, 0, 0, $width_stamp, $height_stamp,70);

            //The new image is saved in its slot
            imagepng($image, $newFilename, 1);

            //Deleting the original image cuz we don't need it anymore
            imagedestroy($image);
            //unlink($destination);


            //SAVING THE NEW IMAGE IN THE BDD
            
            $q ='INSERT INTO PORTFOLIO_IMAGES (nom,	description,prestataire) VALUES (:nom, :description, :prestataire)';
            $req = $bdd->prepare($q);
            $req -> execute([
                'nom' => $newFilename,
                'description' => htmlspecialchars($_POST['description']),
                'prestataire' => $id_presta
            ]);

            header('location: pro_profile.php?message_photo=Photo enregistrée avec succès');
            exit;




    }
}
