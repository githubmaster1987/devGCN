<?php 
if((!isset($_GET['id'])) || $_GET['id'] == "")
{
	header("Location:../index.php");
}


Require("../connexionBDD.php");
$querypdf = "SELECT * FROM `EDN_Dons`, `EDN_Donateurs` WHERE EDN_Donateurs.ID_Donateur = EDN_Dons.ID_Donateur AND `ID_Dons` = ".$_GET['id']." LIMIT 1;";

$querypdfResult = mysql_query($querypdf);
$sqldata = mysql_fetch_array($querypdfResult);
		
require_once('fpdf.php');
require_once('fpdi.php'); 


//Recuperation de toute les informations : 
$ID_Recu = $sqldata['ID_Dons'];
$Nom_Prenom = utf8_decode(strtoupper($sqldata['Nom']) ." " . ucfirst(strtolower($sqldata['Prenom'])));
$Adresse  = utf8_decode($sqldata['Adresse'] . " " . $sqldata['CP'] . " " . $sqldata['Ville']);
$CPVILLE = utf8_decode($sqldata['CP'] . " " . $sqldata['Ville']);

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('ModelesDONS.pdf'); 
// import page 1 

$tplIdx = $pdf->importPage(1); 
// use the imported page and place it at point 10,10 with a width of 100 mm 
$pdf->useTemplate($tplIdx, 0, 0);
$f = $pdf->getTemplatesize($tplIdx);




// Nom Prenom
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(30, 18); 
$pdf->Write(0, $Nom_Prenom); 

// Adresse
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(37, 26); 
$pdf->Write(0, $Adresse);

// CP & Ville
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('14');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(100, 59); 
$pdf->Write(0, $CPVILLE); 

// Date AUJ
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(133, 226); 
$pdf->Write(0, date("d/m/y")); 




$pdf->Output($DateDons .' - '. $Nom_Prenom . utf8_decode(' - Reçu au titre des dons.pdf'), 'D');
?>