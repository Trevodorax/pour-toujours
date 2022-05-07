<?php 
session_start();
include('includes/db.php');

//CHECKING INPUTS (same checkings as in check-sign-up.php) 
//AND DEFINING THE NEW VALUE

    // checking if inputs are set and not empty
    if(isset($_POST['c_name'])){
        if (empty($_POST['c_name'])){
        header('location: settings.php?message=Vous devez remplir le champ nom complet');
        exit;
        } else{
            $new_value = $_POST['c_name'];
        }
    }

    if(isset($_POST['f_name'])){
        if (empty($_POST['f_name'])){
        header('location: settings.php?message=Vous devez remplir le champ nom préféré');
        exit;
    } else {
        $new_value = $_POST['f_name'];
    }
 }

    if(isset($_POST['departement'])) {
        if( empty($_POST['departement'])){
            header('location: settings.php?message=Vous devez sélectionner un département');
            exit;
        } else {
            // processing departement
            $departement = $_POST['departement'];
        
            $departement_name = explode('-', $departement);
            $departement_number = $departement_name[0];
            
            $new_value = $departement_number;
     
        }
    }   

        //checking if phone number exists and is defined
        if(isset($_POST['tel'])){
            if ((empty($_POST['tel']) || !preg_match('#^0[1678]([ \-\.]?[0-9]{2}){4}$#', $_POST['tel']))){
                header('location: settings.php?message=Erreur dans votre saisie');
                exit;
            }
            else{
            // check if phone number already exists
            $q = 'SELECT id FROM PERSONNE WHERE numero_tel = :tel';
            $req = $bdd->prepare($q);
            $req->execute([
                'tel' => $_POST['tel']
            ]);
            $phone = $req->fetchAll();
        
            if(count($phone) != 0){
                header ('location: settings.php?message=Le numéro de téléphone est déjà utilisé');
                exit;
                }

            $new_value = $_POST['tel'];
            }
        }

    // checking if email is correctly filled
    if(isset($_POST['email'])){
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            header('location: settings.php?message=erreur de saisie');
            exit;
        }
        // checking if email already exists
        $q = 'SELECT id FROM PERSONNE WHERE email = :email';
        $req = $bdd->prepare($q);
        $req->execute([
            'email' => $_POST['email']
        ]);
        $email = $req->fetchAll();

        if(count($email) != 0){
            header ('location: settings.php?message=L\'email est déjà utilisé');
            exit;
         }

         $new_value = $_POST['email'];
 }

 // checking and putting gender in the right format for db
    if(isset($_POST['genre'])){
        if (empty($_POST['genre'])){
            header('location: settings.php?message=Vous devez sélectionner un genre');
            exit;
        }
        else{
            if($_POST['genre'] === "Homme"){
                $genre = "H";
            }elseif ($_POST['genre'] === "Femme"){
                $genre = "F";
            }elseif ($_POST['genre'] === "Autre"){
                $genre = "A";
            }elseif($_POST['genre'] === "Préfère ne pas répondre"){
                $genre = "N";
            }
            $new_value = $genre;
        }
    }

    // PRO INPUTS 
    if(isset($_POST['company_name'])){
        if (empty($_POST['company_name'])){
            header('location: settings.php?message=Vous devez remplir le champ nom de votre entreprise');
            exit;
        } 
        else{
            $new_value = $_POST['company_name'];
        }
    }

    if(isset($_POST['tel_pro'])){
        if( empty($_POST['tel_pro']) || !preg_match('#^0[168]([ \-\.]?[0-9]{2}){4}$#', $_POST['tel_pro']) ){
            header('location: settings.php?message=Erreur de saisie');
            exit;
        }
        else {
            
             // checking if phone number is good
             $q = 'SELECT id FROM PRESTATAIRE WHERE telpro = :telpro';
             $req = $bdd->prepare($q);
             $req->execute([
                 'telpro' => $_POST['tel_pro']
             ]);
             $email = $req->fetchAll();
             if(count($email) != 0){
                 header ('location: settings.php?message=Le numéro de téléphone est déjà utilisé');
                 exit;
             }
             $new_value = $_POST['tel_pro'];
        }
    }
   

    if(isset($_POST['email_pro'])) {
        if (empty($_POST['email_pro']) || !filter_var($_POST['email_pro'], FILTER_VALIDATE_EMAIL)){
            header('location: settings.php?message=Erreur du champ email_pro');
            exit;
        }
        else{
             // checking if email is correct
            $q = 'SELECT id FROM PRESTATAIRE WHERE emailpro = :emailpro';
            $req = $bdd->prepare($q);
            $req->execute([
                'emailpro' => $_POST['email_pro']
            ]);
            $email = $req->fetchAll();
            if(count($email) != 0){
                header ('location: settings.php?message=L\'email est déjà utilisé');
                exit;
            }
            $new_value = $_POST['email_pro'];
        }
    }

    // checking if other things are valid
    if(isset($_POST['activite'])) {
        if (empty($_POST['activite'])){
            header("location: settings.php?message=Vous devez sélectionner un secteur d'activité");
            exit;
        }
        $new_value = $_POST['activite'];
    }

    if(isset($_POST['site'])){
        if (empty($_POST['site'])){
            header("location: settings.php?message=Erreur de saisie du lien");
            exit;
        }else{
            $new_value= $_POST['site'];
        }
    }

     // checking image validity
     if(isset($_FILES['image'])){
        if($_FILES['image']['error'] != 4){

            $ext = [
                'image/jpg',
                'image/jpeg',
                'image/gif',
                'image/png'
            ];

            if(!in_array($_FILES['image']['type'], $ext)){
                header ('location: settings.php?message=Format d\'image incorrect');
                exit;
            }

        $maxSize = 4 * 1024 * 1024;

        if($_FILES['image']['size'] > $maxSize){
            header('location: settings.php?message=L\'image ne doit pas dépasser 4 Mo');
            exit;
        }

        // putting the image in the right folder
        $path = 'images/prestataires';
        if(!file_exists($path)){
            mkdir($path, 0777,true);
            // the third parameter, allows the creation of a recursive $path
        }

        $filename = $_FILES['image']['name'];

        $array = explode('.', $filename);
        $extension = end($array);

        $filename = 'image-' . time() . '.' . $extension;

        $destination = $path . '/' . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        $new_value = $filename;
    }
    
} 

// END OF CHECKING INPUTS 


//Updating the db : 

////PARAMETERS FOR THE REQUEST
$personne_columns = ['nomComplet', 'nomPrefere', 'date_naissance', 'genre', 'email', 'numero_tel', 'departement', 'date_inscription'];
$prestataire_columns = ['nomEntreprise', 'telPro', 'emailPro', 'metier', 'description', 'photoProfil', 'lienSiteWeb'];

$modified_table = (in_array($_POST['column'], $personne_columns) ? 'PERSONNE' : (in_array($_POST['column'], $prestataire_columns) ? 'PRESTATAIRE' : 'ERREUR'));

if($modified_table == 'ERREUR'){
    header('location: settings.php?');
    exit;
} else {

    $condition_col = ($modified_table == 'PERSONNE') ? 'id' : 'personne' ;
}

$column = $_POST['column'];

//REQUEST
$q = 'UPDATE ' . $modified_table . ' SET ' . $column . ' = :new_value WHERE ' . $condition_col . ' = :personne' ;
$req = $bdd->prepare($q);

try{
    $req->execute([
        'new_value' => $new_value,
        'personne' => $_SESSION['id']
    ]);
} catch(PDOException $e) {

    header('location: settings.php?result=fail');
    exit;
}

//CHANGING SESSION PARAMS SO EVERYTHING IS STILL UP TO DATE

if(isset($_SESSION[$column])){
    $_SESSION[$column] = $new_value ;
}

header('location: settings.php?result=success');
exit;
?>