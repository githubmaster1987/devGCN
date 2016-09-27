<?php
	// No cache
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date dans le passé
	
	// Gestion fiches d'informations
	$fiche_fichier = get_fiche($_GET['fiche']);
	$fiche_fichier2 = get_fiche($_GET['fiche2']);
	$fiche_fichier3 = get_fiche($_GET['fiche3']);
	
	// Gestion ordonnances1
	$ordonnance_fichier1 = $_GET['ordonnance1'];
	$ordonnance_fichier2 = $_GET['ordonnance2'];
	$ordonnance_fichier3 = $_GET['ordonnance3'];
	
	function get_fiche($fiche)
	{
		switch ($fiche)
		{
			case 'chirurgie1' : $fiche_fichier = "23_chirurgie_des_petites_levres"; break;
			case 'chirurgie2' : $fiche_fichier = "18_lifting_face_interne_cuisse"; break;
			case 'chirurgie3' : $fiche_fichier = "9_lifting_fronto_temporal_endoscopique"; break;
			case 'chirurgie4' : $fiche_fichier = "2_genioplastie"; break;
			case 'chirurgie5' : $fiche_fichier = "24_penoplastie"; break;
			case 'chirurgie6' : $fiche_fichier = "4_blepharoplastie"; break;
			case 'chirurgie6en' : $fiche_fichier = "A3_Cosmetic_blepharoplasty"; break;
			case 'chirurgie7' : $fiche_fichier = "17_body_lift"; break;
			case 'chirurgie8' : $fiche_fichier = "10_chirurgie_de_la_calvitie"; break;
			case 'chirurgie9' : $fiche_fichier = "3_chirurgie_des_oreilles_decollees"; break;
			case 'chirurgie9en' : $fiche_fichier = "A2_Prominent_ears_surgery"; break;
			case 'chirurgie10' : $fiche_fichier = "1_rhinoplastie"; break;
			case 'chirurgie10en' : $fiche_fichier = "A1_Rhinoplasty_cosmetic_nose_surgery"; break;
			case 'chirurgie11' : $fiche_fichier = "5_lifting_cervico_facial"; break;
			case 'chirurgie11en' : $fiche_fichier = "A4_Face_lift"; break;			
			case 'chirurgie12' : $fiche_fichier = "6_Lifting_temporal_non_endoscopique"; break;
			case 'chirurgie13' : $fiche_fichier = "7_Lifting_centro_facial"; break;
			case 'chirurgie14' : $fiche_fichier = "8_lifting_facial_sous_endoscopie"; break;
			case 'chirurgie14en' : $fiche_fichier = "A12_Endoscopic_forehead_lifts"; break;
			case 'chirurgie15' : $fiche_fichier = "16_CPE_paroi_abdominale"; break;
			case 'chirurgie15en' : $fiche_fichier = "A7_Abdominal_wall_plastic_and_aesthetic_surgery"; break;
			case 'chirurgie16' : $fiche_fichier = "19_Lifting_de_la_face_interne_du_bras"; break;
			case 'chirurgie16en' : $fiche_fichier = "A10_Arm_inner_side_lifting"; break;
			case 'chirurgiemain1' : $fiche_fichier = "40_Le_kyste_synovial"; break;
			case 'chirurgiemain2' : $fiche_fichier = "41_maladie_de_dupuytren"; break;
			case 'chirurgiemain3' : $fiche_fichier = "42_syndrome_canal_carpien"; break;
			case 'chirurgieplastique1' : $fiche_fichier = "26_chirurgie_des_tumeurs_cutanees"; break;
			case 'chirurgieplastique2' : $fiche_fichier = "25_chirurgie_cutanee"; break;
			case 'cmf' : $fiche_fichier = "43_kystes_et_fistules_de_la_partie_laterale_du_cou"; break;
			case 'esthetique1' : $fiche_fichier = "28_acide_hyaluronique"; break;
			case 'esthetique2' : $fiche_fichier = "27_Injections_de_produits_de_comblement"; break;
			case 'esthetique2en' : $fiche_fichier = "A11_The_botulinic_toxin"; break;
			case 'esthetique3' : $fiche_fichier = "30_dermabrasion"; break;
			case 'esthetique4' : $fiche_fichier = "31_Peelings_du_visage"; break;
			case 'esthetique5' : $fiche_fichier = "32_Abrasion_visage_par_laser"; break;
			case 'esthetique6' : $fiche_fichier = "20_lipoaspiration"; break;
			case 'esthetique6en' : $fiche_fichier = "A8_Liposuction"; break;
			case 'gyneco' : $fiche_fichier = "15_gynecomastie"; break;
			case 'gynecoen' : $fiche_fichier = "A6_Breast_lift_mastopexy"; break;
			case 'seins1' : $fiche_fichier = "33_Reconstruction_du_sein_par_prothese"; break;
			case 'seins2' : $fiche_fichier = "34_Reconstruction_du_sein_par_grand_dorsal"; break;
			case 'seins3' : $fiche_fichier = "35_reconstruction_sein_grand_droit_abdomen"; break;
			case 'seins4' : $fiche_fichier = "36_Reconstruction_du_sein_par_lambeau_DIEP"; break;
			case 'seins5' : $fiche_fichier = "13_protheses_mammaires"; break;
			case 'seins5en' : $fiche_fichier = "A5_Mammary_implants_and_breast_hypophasia"; break;
			case 'seins6' : $fiche_fichier = "37_reconstruction_plaque_aerolo_mamelonnaire"; break;
			case 'transferts1' : $fiche_fichier = "14_Transfert_graisseux_augmentation_mammaire_a_visee_esthetique_ou_malformations_congenitales"; break;
			case 'transferts2' : $fiche_fichier = "39_Transfert_graisseux_pour_la_correction_des_sequelles_du_traitement_conservateur_du_cancer_du_sein"; break;
			case 'transferts3' : $fiche_fichier = "38_Transfert_graisseux_pour_reconstruction_mammaire_apres_mastectomie_totale"; break;
			case '' : $fiche_ficher = ""; break;
		}
		return $fiche_fichier;		
	}
	
	function get_nom_ordonnance($num)
	{
		switch($num)
		{
			case "1" : $nom_fichier = "Ordonnance Calvitie"; break;
			case "2" : $nom_fichier = "Ordonnance Htm"; break;
			case "3" : $nom_fichier = "Ordonnance Lifting"; break;
			case "4" : $nom_fichier = "Ordonnance Oreilles"; break;
			case "5" : $nom_fichier = "Ordonnance Paupieres"; break;
			case "6" : $nom_fichier = "Ordonnance Plastie"; break;
			case "7" : $nom_fichier = "Ordonnance Protheses"; break;
			case "8" : $nom_fichier = "Ordonnance Ptose"; break;
			case "9" : $nom_fichier = "Ordonnance Rhino"; break;
			case "12" : $nom_fichier = "Ordonnance Vierge"; break;
			case "11" : $nom_fichier = "Ordonnance Lipo"; break;			
		}
		return($nom_fichier);
	}
				
	// Variables
	$nom = $_GET['nom'];
	$destinataire = $_GET['email'];
	//$destinataire = 'cyril.carraz@gmail.com';
	//$destinataire = 'phbellity@gmail.com';
	$expediteur = $_GET['expediteur_mail'];
	$expediteur_identite = stripslashes(utf8_decode($_GET['expediteur']));
	$objet = "Dossier Docteur Bellity";
	
	// Récup fichiers
	$fichier1 = "Mail/devis.pdf";
	$fichier2 = "Mail/consentement.pdf";
	$fichier3 = "Mail/fiches/$fiche_fichier.pdf";
		$fichier3_2 = "Mail/fiches/$fiche_fichier2.pdf";
		$fichier3_3 = "Mail/fiches/$fiche_fichier3.pdf";
	$fichier4 = "Mail/ordonnances/$ordonnance_fichier1.pdf";
		$fichier4_2 = "Mail/ordonnances/$ordonnance_fichier2.pdf";
		$fichier4_3 = "Mail/ordonnances/$ordonnance_fichier3.pdf";

	$fichier1name = 'Devis.pdf';
	$fichier2name = 'Consentement éclairé.pdf';
	$fichier3name = $fiche_fichier.'.pdf';
		$fichier3_2name = $fiche_fichier2.'.pdf';
		$fichier3_3name = $fiche_fichier3.'.pdf';
	$fichier4name = get_nom_ordonnance($ordonnance_fichier1).'.pdf';
		$fichier4_2name = get_nom_ordonnance($ordonnance_fichier2).'.pdf';
		$fichier4_3name = get_nom_ordonnance($ordonnance_fichier3).'.pdf';

	$boundary = "-----=".md5(uniqid(rand()));
	$boundary_alt = "-----=".md5(rand());
	$header = "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
	$header .= "\r\n";	
	$msg .= "--$boundary\r\n";
	$msg .= "\r\n";

	$msg .= "$nom,
		
A la suite de notre consultation, veuillez trouver les éléments relatifs à votre intervention :

- Devis (à nous renvoyer signé)
- Consentement éclairé (à nous renvoyer signé).
- Fiche d'information sur la chirurgie concernée (à nous renvoyer signé)
- Ordonnances

Apres réflexion et analyse de ces documents veuillez nous confirmer vos intentions en appelant 
Corinne au 06 18 58 49 55 ou simplement par retour de mail.

Le numéro de téléphone du médecin anesthésite à contacter :
Dr Edwige Loiseau  06 07 03 87 96 

N’hesitez pas a nous contacter pour toute information complémentaire.

Bien cordialement,
$expediteur_identite

Dr Philippe Bellity
29, avenue Hoche 75008 PARIS
Tel. (+33) (0)1 49 53 00 00
Fax. (+33) (0)1 72 09 13 13
www.chirurgie-esthetique-bellity.com";
		
	$msg .= "\r\n";
	
	// Fichier 1
	$attachment = chunk_split(base64_encode(file_get_contents($fichier1)));
	$msg .= "--$boundary\r\n";
	$msg .= "Content-Type: pdf; name=\"$fichier1\"\r\n";
	$msg .= "Content-Transfer-Encoding: base64\r\n";
	$msg .= "Content-Disposition: inline; filename=\"$fichier1name\"\r\n";
	$msg .= "\r\n";
	$msg .= $attachment."\r\n";
	$msg .= "\r\n\r\n";

	// Fichier 2
	$attachment = chunk_split(base64_encode(file_get_contents($fichier2)));		
	$msg .= "--$boundary\r\n";
	$msg .= "Content-Type: pdf; name=\"$fichier2\"\r\n";
	$msg .= "Content-Transfer-Encoding: base64\r\n";
	$msg .= "Content-Disposition: attachment; filename=\"$fichier2name\"\r\n";
	$msg .= "\r\n";
	$msg .= $attachment."\r\n";
	$msg .= "\r\n\r\n";
	
	// Fichier 3
	$attachment = chunk_split(base64_encode(file_get_contents($fichier3)));
	$msg .= "--$boundary\r\n";
	$msg .= "Content-Type: pdf; name=\"$fichier3\"\r\n";
	$msg .= "Content-Transfer-Encoding: base64\r\n";
	$msg .= "Content-Disposition: inline; filename=\"$fichier3name\"\r\n";
	$msg .= "\r\n";
	$msg .= $attachment."\r\n";
	$msg .= "\r\n\r\n";
	
		if ($fiche_fichier2 != '')
		{
			// Fichier 3_2
			$attachment = chunk_split(base64_encode(file_get_contents($fichier3_2)));
			$msg .= "--$boundary\r\n";
			$msg .= "Content-Type: pdf; name=\"$fichier3_2\"\r\n";
			$msg .= "Content-Transfer-Encoding: base64\r\n";
			$msg .= "Content-Disposition: inline; filename=\"$fichier3_2name\"\r\n";
			$msg .= "\r\n";
			$msg .= $attachment."\r\n";
			$msg .= "\r\n\r\n";
		}
		
		if ($fiche_fichier3 != '')
		{
			// Fichier 3_3
			$attachment = chunk_split(base64_encode(file_get_contents($fichier3_3)));
			$msg .= "--$boundary\r\n";
			$msg .= "Content-Type: pdf; name=\"$fichier3_3\"\r\n";
			$msg .= "Content-Transfer-Encoding: base64\r\n";
			$msg .= "Content-Disposition: inline; filename=\"$fichier3_3name\"\r\n";
			$msg .= "\r\n";
			$msg .= $attachment."\r\n";
			$msg .= "\r\n\r\n";
		}		

	// Fichier 4
	$attachment = chunk_split(base64_encode(file_get_contents($fichier4)));				
	$msg .= "--$boundary\r\n";
	$msg .= "Content-Type: pdf; name=\"$fichier4\"\r\n";
	$msg .= "Content-Transfer-Encoding: base64\r\n";
	$msg .= "Content-Disposition: attachment; filename=\"$fichier4name\"\r\n";
	$msg .= "\r\n";
	$msg .= $attachment."\r\n";
	$msg .= "\r\n\r\n";
	
		if ($ordonnance_fichier2 != '')
		{
			// Fichier 4_2
			$attachment = chunk_split(base64_encode(file_get_contents($fichier4_2)));
			$msg .= "--$boundary\r\n";
			$msg .= "Content-Type: pdf; name=\"$fichier4_2\"\r\n";
			$msg .= "Content-Transfer-Encoding: base64\r\n";
			$msg .= "Content-Disposition: inline; filename=\"$fichier4_2name\"\r\n";
			$msg .= "\r\n";
			$msg .= $attachment."\r\n";
			$msg .= "\r\n\r\n";
		}
		
		if ($ordonnance_fichier3 != '')
		{
			// Fichier 4_3
			$attachment = chunk_split(base64_encode(file_get_contents($fichier4_3)));
			$msg .= "--$boundary\r\n";
			$msg .= "Content-Type: pdf; name=\"$fichier4_3\"\r\n";
			$msg .= "Content-Transfer-Encoding: base64\r\n";
			$msg .= "Content-Disposition: inline; filename=\"$fichier4_3name\"\r\n";
			$msg .= "\r\n";
			$msg .= $attachment."\r\n";
			$msg .= "\r\n\r\n";
		}	
	
	$msg .= "--$boundary--\r\n";		
	
	// Mail
	mail($destinataire, $objet, $msg,"Reply-to: $expediteur\r\nFrom: ".$expediteur."\r\n".$header);
	mail($expediteur, $objet, $msg,"Reply-to: $expediteur\r\nFrom: ".$expediteur."\r\n".$header);

	// Suppression des PDF du dossier Mail et dossier Ordonnances
	unlink($fichier1);
	unlink($fichier2);
	unlink($fichier4);
	if ($ordonnance_fichier2 != '') unlink($fichier4_2);
	if ($ordonnance_fichier3 != '') unlink($fichier4_3);
?>