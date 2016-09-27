<?php 
if(!isset($_GET['IdDevis']))
{
		header("Location:../index.php");
}
else{
	$IdDevis = $_GET['IdDevis'];
}

Require("../connexionBDD.php");

$queryDevis = "SELECT * FROM Devis WHERE `Id`= '".$IdDevis."';";
$queryDevisResult = mysql_query($queryDevis);
$sqldata = mysql_fetch_array($queryDevisResult);
$PatientID = $sqldata['PatientId'];


$nat_int = $sqldata['Nat_Int'];
$date_int = $sqldata['Date_Int'];
$date_etab= $sqldata['Date_Etab'];
$anes = $sqldata['Anesthesie'];


$CliniqueID = $sqldata['CliniqueId'];

$sqlinfospatient = "SELECT DateN, Nom, Prenom FROM Patients WHERE Id='".$PatientID."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata_patient= mysql_fetch_array($sqlresult);
$Nom_Prenom = strtoupper($sqldata_patient['Nom'])." ". ucfirst(strtolower($sqldata_patient['Prenom']));
$date_naissance = substr($sqldata_patient['DateN'],8,2).'/'.substr($sqldata_patient['DateN'],5,2).'/'.substr($sqldata_patient['DateN'],0,4);

require_once('fpdf.php');
require_once('fpdi.php'); 

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage();
// set the sourcefile 
$pdf->setSourceFile('../Doc/Consentement.pdf'); 
// import page 1 

$tplIdx = $pdf->importPage(1,'/MediaBox');
$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx);

$pdf->SetFillColor(255,255,255);	
//$pdf->Rect(117, 64,20,7, "F");

$pdf->SetFillColor(255,255,255);	
//$pdf->Rect(133, 57 ,35,7, "F");

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(0, 0 ,$s['w'],30, "F");
$pdf->Rect(0, $s['h']-30 ,$s['w'],30, "F");

/*$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);*/

$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(45, 48.6); 
$pdf->Write(1, $Nom_Prenom);

$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(94,48.6);
$pdf->Write(1, $date_etab);

$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(56, 64.8); 
$pdf->Write(1, $Nom_Prenom);

$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(108, 64.8); 
$pdf->Write(1, $date_naissance);

$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(31, 81); 
$pdf->Write(1, $nat_int); 

/*$pdf->SetFont('Arial');
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(34,77.5); 
$pdf->Write(1, $date_int);*/



/*$pdf->SetFont('Arial'); 
$pdf->SetFontSize('9');
$pdf->SetTextColor(0,0,0); 
$pdf->SetXY(86.3, 128.5); 
$pdf->Write(1, $anes);*/

// Page 2
$pdf->AddPage();
$tplIdx2 = $pdf->importPage(2,'/MediaBox');
$pdf->useTemplate($tplIdx2, 0, 0);

// Page 3
/*$pdf->AddPage();
$tplIdx3 = $pdf->importPage(3,'/MediaBox');
$pdf->useTemplate($tplIdx3, 0, 0);*/

// Sortie
$pdf->Output('../Mail/consentement.pdf', 'F');
$pdf->Output($Nom_Prenom . ' - Consentement.pdf', 'D');
//$pdf->Output($Nom_Prenom . ' - Consentement.pdf', 'I');
?>