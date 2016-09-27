<?php
	// Includes
	include 'PHPExcel-1.7.7/Classes/PHPExcel.php';
	include 'PHPExcel-1.7.7/Classes/PHPExcel/Writer/Excel5.php';
	
	Require("connexionBDD.php");
		
	// Ouverture modèle
	$objet = PHPExcel_IOFactory::createReader('Excel5');
	$excel = $objet->load('Paiements.xls');
	$sheet = $excel->getSheet(0);
	$sheet->setTitle(utf8_encode('Paiements'));
	
	// Récup variables
	$patient = $_GET['patient'];
	$montant = $_GET['montant'];
	$montant_bdd = $_GET['montant'];
	$montant = str_replace(chr(0xC2).chr(0x80) , chr(0xE2).chr(0x82).chr(0xAC), utf8_encode($montant.' €'));
	$moyendepaiement = $_GET['moyendepaiement'];
	$type = $_GET['type'];
	$today = date('d/m/Y');
	$today_bdd = date('Y-m-d');

	// Ajout en base de données
	$request = "INSERT INTO paiements(nom,date,type,moyendepaiement,montant) VALUES('".$patient."','".$today_bdd."','".$type."','".$moyendepaiement."','".$montant_bdd."')"; 
	mysql_query($request);
		
	// Première ligne
	$i = 2;

	// Tant que ligne remplie, sauter ligne jusqu'à ligne vide
	while (strstr($sheet->getCell('C'.$i)->getValue(),'Consultation') or strstr($sheet->getCell('C'.$i)->getValue(),'Injection') or strstr($sheet->getCell('C'.$i)->getValue(),'Chirurgie'))
	{
		$i++;
	}
	
	// Remplissage lignes
	$sheet->setCellValue('A'.$i,utf8_encode($patient));
	$sheet->setCellValue('B'.$i,$today);
	$sheet->setCellValue('C'.$i,$type);
	$sheet->setCellValue('D'.$i,$moyendepaiement);
	$sheet->setCellValue('E'.$i,$montant);
	
	// Writer
	$writer = new PHPExcel_Writer_Excel5($excel);
	$writer->save('Paiements.xls');	
?>