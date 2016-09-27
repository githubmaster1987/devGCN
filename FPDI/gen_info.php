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
$Nature = $sqldata['Nat_Int'];
$Anesthesie = $sqldata['Anesthesie'];

$FraisCH = $sqldata['FraisCH']. " " . chr(128);
$FraisHC = $sqldata['FraisHC']. " " . chr(128);
$AideOp = $sqldata['AideOp']. " " . chr(128);
$FraisHA = $sqldata['FraisHA']. " " . chr(128);
$FraisMat = $sqldata['FraisMat']. " " . chr(128);
$TotalEuro = $sqldata['Total']. " " . chr(128);



$heure = $sqldata['Heure_Int'];

$date = $sqldata['Date_Int'];


$CliniqueID = $sqldata['CliniqueId'];

$sqlinfospatient = "SELECT Nom, Prenom, Civilite FROM Patients WHERE Id='".$PatientID."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata_patient= mysql_fetch_array($sqlresult);
$Sexe = $sqldata_patient['Civilite'];
$Nom_Prenom = strtoupper($sqldata_patient['Nom'])." ". ucfirst(strtolower($sqldata_patient['Prenom']));





$queryClinique = "SELECT * FROM Cliniques WHERE `IdClinique`= '".$CliniqueID."';";
$queryCliniqueResult = mysql_query($queryClinique);
$sqldata = mysql_fetch_array($queryCliniqueResult);
$Ligne1 = $sqldata['Clinique'];
$Ligne2 = $sqldata['Adresse'] . ", " . $sqldata['Ville'] . " " . $sqldata['CP'];
$Ligne3 = "Tel : ". $sqldata['Tel'];
$Ligne4 = "Fax : ". $sqldata['Fax'];
/*$Ligne5 = "Mail : ". $sqldata['Mail'];*/

require_once('fpdf.php');
require_once('fpdi.php'); 

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('../Doc/InfosPatients.pdf'); 
// import page 1 


$tplIdx = $pdf->importPage(1); 

$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx); 


$pdf->SetFillColor(255,255,255);	
$pdf->Rect(115.5, 64,20,7, "F");

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(133, 57 ,35,7, "F");

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(0, 0 ,$s['w'],45, "F");
$pdf->Rect(0, $s['h']-45 ,$s['w'],45, "F");

$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);


$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(15, 70); 
$pdf->Write(1, $Sexe); 



$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(33, 70); 
$pdf->Write(1, $Nom_Prenom); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(50, 115.5); 
$pdf->Write(4, $Nature); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(46, 124.5); 
$pdf->Write(1, $Anesthesie); 



$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
//$pdf->SetXY(115.8, 66.4); 
$pdf->SetXY(117, 86.4); 
$pdf->Write(1, $heure); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(133.5, 78.4); 
$pdf->Write(1, $date); 

$pdf->SetFontSize(12); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 94.5); 
$pdf->Write(1, $Ligne1); 

$pdf->SetFontSize(9); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 99.9); 
$pdf->Write(1, $Ligne2); 

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 104.5); 
$pdf->Write(1, $Ligne3); 

/**** Ajout Cyril ****/
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 108.9); 
/*
$pdf->Write(1, 'Fax : 0170640036');
$pdf->Write(1, $Ligne4);
*/

/*$pdf->SetTextColor(0,0,0);
$pdf->SetXY(80, 93.5); 
$pdf->Write(1, 'Mail : 0170640036');*/


$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(128, 139); 
$pdf->Write(1, $FraisCH); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(95, 150); 
$pdf->Write(1, $FraisHA); 

$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(88, 171.5); 
$pdf->Write(1, $FraisMat);


//Fin page 1
$pdf->AddPage('P', array($s['w'], $s['h']));
$pdf->setSourceFile('../Doc/InfosPatients.pdf'); 
$tplIdx = $pdf->importPage(2); 
$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx); 

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(0, 0 ,$s['w'],30, "F");
$pdf->Rect(0, $s['h']-30 ,$s['w'],30, "F");

$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);




$pdf->Output($Nom_Prenom . ' - Informations.pdf', 'D');
?>