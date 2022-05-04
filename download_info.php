<?php
    session_start();
    require('includes/FPDF/fpdf.php');

    class PDF extends FPDF{
        function Header(){
            $this->SetFont('Arial','B',20);
            $this->Image('images/logo.png', 10, 10, 20, 20);
            $this->Cell(20, 20);
            $this->Cell(0,10,'Vos informations - Pour Toujours', 0, 1);
            $this->Ln(20);
        }
        function Footer(){

        }
    }

    include ('includes/db.php');

    $email = $_SESSION['email'];

    $q = 'SELECT * FROM PERSONNE WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute([$email]);
    $personne = $req->fetch();

    $q = 'SELECT * FROM UTILISATEUR WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$personne[0]]);
    $utilisateur = $req->fetch();

    $q = 'SELECT * FROM PRESTATAIRE WHERE personne = ?';
    $req = $bdd->prepare($q);
    $req->execute([$personne[0]]);
    $prestataire = $req->fetch();

    $pdf = new PDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(0, 10, 'Nom Complet : ' . $personne[1], 0, 1);
        $pdf->Cell(0, 10, 'Nom Prefere : ' . $personne[2], 0, 1);
        $pdf->Cell(0, 10, 'Date de Naissance : ' . $personne[3], 0, 1);
        $pdf->Cell(0, 10, 'Genre : ' . $personne[4], 0, 1);
        $pdf->Cell(0, 10, 'Email : ' . $personne[5], 0, 1);
        $pdf->Cell(0, 10, 'Numero de telephone : ' . $personne[7], 0, 1);
        $pdf->Cell(0, 10, 'Departement : ' . $personne[8], 0, 1);
        $pdf->Cell(0, 10, 'Cle : ' . $personne[8], 0, 1);
        $pdf->Cell(0, 10, 'Date d\'inscription : ' . $personne[8], 0, 1);
        if ($utilisateur != false){
            $pdf->ln(10);
            $pdf->Cell(0, 10, 'Preferences : ' . $utilisateur[1], 0, 1);
            $pdf->Cell(0, 10, 'Avatar : ' . $utilisateur[2], 0, 1);
        }
        if ($prestataire != false){
            $pdf->ln(10);
            $pdf->Cell(0, 10, 'Nom de votre entreprise : ' . $prestataire[1], 0, 1);
            $pdf->Cell(0, 10, 'Numero de telephone professionnel : ' . $prestataire[2], 0, 1);
            $pdf->Cell(0, 10, 'Email professionnel : ' . $prestataire[3], 0, 1);
            $pdf->Cell(0, 10, 'Metier : ' . $prestataire[4], 0, 1);
            $pdf->Cell(0, 10, 'Description : ' . $prestataire[5], 0, 1);
            $pdf->Cell(0, 10, 'Photo de profil : ' . $prestataire[6], 0, 1);
            $pdf->Cell(0, 10, 'Lien du site web : ' . $prestataire[7], 0, 1);
            $pdf->Cell(0, 10, 'Signature : ' . $prestataire[8], 0, 1);
        }
        $pdf->Output();

?>
