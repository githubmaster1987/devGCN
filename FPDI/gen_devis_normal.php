<?php 
if(!isset($_GET['IdDevis']))
{
		header("Location:../index.php");
}
else{
	$IdDevis = $_GET['IdDevis'];
}

Require("../connexionBDD.php");

$queryDevis = "SELECT * , (`FraisCH`+`FraisHC`+`AideOp`+`FraisHA`+`FraisMat`) as Total FROM `Devis` WHERE `Id`= '".$IdDevis."';";
$queryDevisResult = mysql_query($queryDevis);
$sqldata = mysql_fetch_array($queryDevisResult);
$PatientID = $sqldata['PatientId'];

$date_int = $sqldata['Date_Int'];

$anes = ucfirst(strtolower($sqldata['Anesthesie']));
$date_prem = $sqldata['Date_Prem_Cons'];
$date_etab= $sqldata['Date_Etab'];
$nature_int = ucfirst(strtolower($sqldata['Nat_Int']));
	

$FraisCH = $sqldata['FraisCH']. " " . chr(128);
$FraisHC = $sqldata['FraisHC']. " " . chr(128);
$hcht=$sqldata['FraisHC'];
$hctva=round($hcht*0.2);
$hcttc=round($hcht*1.2). " " . chr(128);
$AideOp = $sqldata['AideOp']. " " . chr(128);
$FraisHA = $sqldata['FraisHA']. " " . chr(128);
$FraisMat = $sqldata['FraisMat']. " " . chr(128);
$TotalEuro = $sqldata['Total']. " " . chr(128);
$TotalEurottc=$TotalEuro + $hctva. " " . chr(128);


           

$CliniqueID = $sqldata['CliniqueId'];

$sqlinfospatient = "SELECT * FROM Patients WHERE Id='".$PatientID."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata_patient= mysql_fetch_array($sqlresult);
$Nom_Prenom = strtoupper($sqldata_patient['Nom'])." ". ucfirst(strtolower($sqldata_patient['Prenom']));
$Nom = strtoupper($sqldata_patient['Nom']);
$Prenom = ucfirst(strtolower($sqldata_patient['Prenom']));
$Prof = $sqldata_patient['Profession'];
$date = $sqldata_patient['DateN'];
$jour = substr($date, 8, 2);
$mois = substr($date, 5, 2);
$annee = substr($date, 0, 4);
$DateNaissance = "$jour/$mois/$annee";
$Adresse =  $sqldata_patient['Adresse'] . " " . $sqldata_patient['Cp'] . " " .$sqldata_patient['Ville'];


$sqlCli = "Select * From `Cliniques` Where `IdClinique` = '".$sqldata['CliniqueId']."' LIMIT 1;";
$sqlRecupCli=mysql_query($sqlCli);
$sqldataCli = mysql_fetch_array($sqlRecupCli);
$ligne_adresse = $sqldataCli['Clinique'] . " - " .$sqldataCli['Adresse'] . " " . $sqldataCli['CP'] . " " .$sqldataCli['Ville'];
	
	
require_once('fpdf.php');
require_once('fpdi.php'); 


// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('../Doc/devis_normal.pdf'); 
// import page 1 
$pdf->SetFontSize(9); 

$tplIdx = $pdf->importPage(1); 
$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx); 


$pdf->SetFillColor(255,255,255);	

$pdf->Rect(40, 80 ,22,8, "F");  
$pdf->Rect(75, 140 ,100,8, "F");  


$pdf->Rect(0, 0 ,$s['w'],30, "F");
$pdf->Rect(0, $s['h']-30 ,$s['w'],30, "F");

$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);


$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(67.6, 76.3);  
$pdf->Write(1, $nature_int ); 

$pdf->SetXY(40.4, 83.8); 
$pdf->Write(1, $anes ); 

$pdf->SetXY(22, 114.5); 
$pdf->Write(1, $Nom ); 

$pdf->SetXY(25.8, 118.4); 
$pdf->Write(1, $Prenom ); 

$pdf->SetXY(29.7, 122.3); 
$pdf->Write(1, $Prof ); 

$pdf->SetXY(40.5, 126.2); 
$pdf->Write(1, $DateNaissance ); 

$pdf->SetXY(26.3, 130.1); 
$pdf->Write(1, $Adresse ); 

$pdf->SetXY(54.8, 137.7); 
$pdf->Write(1, $date_prem ); 

$pdf->SetXY(75, 145.1); 
$pdf->Write(1, $ligne_adresse ); 

$pdf->SetXY(62, 152.5); 
$pdf->Write(1, $date_int ); 

$pdf->SetXY(63, 171.5); 
$pdf->Write(1, $FraisCH ); 

$pdf->SetXY(61, 163.2); 
$pdf->Write(1, $hcttc ); 

$pdf->SetXY(38.7, 167); 
$pdf->Write(1, $AideOp ); 

$pdf->SetXY(68, 175); 
$pdf->Write(1, $FraisHA ); 

$pdf->SetXY(42, 179.7); 
$pdf->Write(1, $FraisMat ); 

$pdf->SetXY(39.3, 186.7); 
$pdf->Write(1, $TotalEurottc ); 






 


//Fin page 1
$pdf->AddPage('P', array($s['w'], $s['h']));
$pdf->setSourceFile('../Doc/devis_normal.pdf'); 
$tplIdx = $pdf->importPage(2); 
$pdf->useTemplate($tplIdx, 0, 0);
$s = $pdf->getTemplatesize($tplIdx); 

$pdf->SetFillColor(255,255,255);	
$pdf->Rect(0, 0 ,$s['w'],30, "F");
$pdf->Rect(0, $s['h']-30 ,$s['w'],30, "F");

$pdf->setSourceFile('template/template.pdf'); 
$tplheader = $pdf->importPage(1);
$pdf->useTemplate($tplheader, 0, 0);

$pdf->SetXY(68.6, 129); 
$pdf->Write(1, $date_etab ); 

$pdf->SetXY(85, 71.3); 
$pdf->Write(1, $Nom_Prenom );

$pdf->Output('../Mail/devis.pdf', 'F');
$pdf->Output($Nom_Prenom . ' - Devis CEM.pdf', 'D');
?>