<?php

if(isset($_GET['type_ordo'])) $_POST['type_ordo'] = $_GET['type_ordo'];
if(isset($_GET['PatientID'])) $_POST['PatientID'] = $_GET['PatientID'];

if(!isset($_POST['type_ordo']))
	{
		header("Location:../index.php");
	}
if(!isset($_POST['PatientID']))
	{
		header("Location:../index.php");
	}
	



Require("../connexionBDD.php");
$ini_gcm = parse_ini_file("../gcm.ini");
$querypdf = "SELECT * FROM `Ordonnances` WHERE `Id` = ".$_POST['type_ordo']." LIMIT 1;";
$querypdfResult = mysql_query($querypdf);
$sqldata = mysql_fetch_array($querypdfResult);

$Nom_Type = $sqldata['Nom'];
$chemin = $sqldata['Chemin'];
$pages_total = $sqldata['NbPages'];

$sqlinfospatient = "SELECT Nom, Prenom FROM Patients WHERE Id='".$_POST['PatientID']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);

$Nom_Prenom = strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom']));
$Date = "Paris, le " . date("d/m/Y");


		
require_once('fpdf.php');
require_once('fpdi.php'); 

 

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('../Ordo/'.$chemin); 

for ($pages = 1; $pages <= $pages_total; $pages++)
{
	$pdf->setSourceFile('../Ordo/'.$chemin);
	if($pages == 1)
	{
		$tplIdx = $pdf->importPage($pages); 
		// use the imported page and place it at point 10,10 with a width of 100 mm 
		$pdf->useTemplate($tplIdx, 0, 0);
		$s = $pdf->getTemplatesize($tplIdx);
		

		
	}else{
	
		$tplIdx = $pdf->importPage($pages); 
		$s = $pdf->getTemplatesize($tplIdx); 
		$pdf->AddPage('P', array($s['w'], $s['h'])); 
		// use the imported page and place it at point 10,10 with a width of 100 mm 
		$pdf->useTemplate($tplIdx, 0, 0 ); 
	}
	$pdf->SetFillColor(255,255,255);	
	$pdf->Rect(0, 0 ,$s['w'],45, "F");
	$pdf->Rect(0, $s['h']-45 ,$s['w'],45, "F");
	$pdf->setSourceFile('template/template.pdf'); 
	$tplheader = $pdf->importPage(1);
	$pdf->useTemplate($tplheader, 0, 0);


	
	$pdf->SetFont('Arial'); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(25, 70); 
	$pdf->Write(1, $Nom_Prenom ); 
	

	$pdf->SetFont('Arial'); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(120, 50); 
	$pdf->Write(1, $Date ); 	
}


$pdf->Output("../Mail/ordonnances/".$_POST['type_ordo'].".pdf", 'F');
$pdf->Output($Nom_Prenom . ' - Ordonnances - ' . $Nom_Type .'.pdf', 'D');

?>