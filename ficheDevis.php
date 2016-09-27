<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

//requete permettant de supprimer un Devis
if(isset ($_POST['Supprimer']))
{
$querySupprimer = "DELETE FROM `Devis` WHERE `Id` = '".$_GET['IdDevis']."';";
$querySupprimerResult = mysql_query($querySupprimer);
header("Location:devisManager.php?PatientId=".$_GET['PatientId']);
}


//requete permettant de recuperer le Devis concerné
if(isset($_GET['IdDevis']))
{
	$devis_id_get = $_GET['IdDevis'];
	$queryDevis = "SELECT * FROM Devis WHERE `Id`= '".$_GET['IdDevis']."';";
	$queryDevisResult = mysql_query($queryDevis);
	$sqldata = mysql_fetch_array($queryDevisResult);
	
	//formatage affichage du type de devis
	if($sqldata['Type_Devis'] == "M")
	{
		$Type = "Acte m&eacute;dical";
		$liendevis = "gen_devis_ccam";
		$nomliendevis = "Imprimer Devis CEM CCAM";
	}
	else if($sqldata['Type_Devis'] == "E")
	{
	if($sqldata['CreatedAt']>= "2016-07-19 00:00:00")
	{
		$Type = "Vis&eacute;e esth&eacute;tique";
		$liendevis = "gen_devis_normal";
		$nomliendevis = "Imprimer Devis CEM (+TVA)";
	}else
	{
		$Type = "Vis&eacute;e esth&eacute;tique";
		$liendevis = "gen_devis_normal_wo_vat";
		$nomliendevis = "Imprimer Devis CEM";
	}
	}
	
	$sqlCli = "Select Clinique From `Cliniques` Where `IdClinique` = '".$sqldata['CliniqueId']."' LIMIT 1;";	
	$sqlRecupCli=mysql_query($sqlCli);
	$sqldataCli = mysql_fetch_array($sqlRecupCli);
	
}else
{
	header("Location:index.php");
}

//requete permettant de recuperer les nom et prenom du Patient auquel appartient de devis
$queryPatient = "SELECT Civilite, Nom, Prenom, Mail FROM Patients WHERE `Id`= '".$sqldata['PatientId']."';";
$queryPatientResult = mysql_query($queryPatient);
$sqldataPatient = mysql_fetch_array($queryPatientResult);


include("header.html");	
?>

	<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
	
	<!--MENU-->
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="devisManager.php?PatientId=<?php echo $sqldata['PatientId']; ?>" style="text-decoration:none;">Retour gestion devis</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $sqldata['PatientId']; ?>" style="text-decoration:none;">Retour fiche patient</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
            <tr height="100px">
                <td><center><h3>Devis (<?php echo $Type; ?>)<br />de "<?php echo strtoupper($sqldataPatient['Nom'])." ". ucfirst(strtolower($sqldataPatient['Prenom'])) ?>"</h3></center></td>	
           </tr>
           <tr height="30"><!--BOUTONS-->
                <td colspan="2">
                    <center>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td valign="top"><input type="button" onclick="redirModifDevis()" value="Modifier" name="modifInfo"/>&nbsp;&nbsp;</td>
                                <td>
                                    <form method="post" onSubmit="return confirm('Etes-vous s&ucirc;r de vouloir supprimer ce devis ?')">
                                        <input type="hidden" name="DevisID" value="<?php echo $sqldata['Id']; ?>" ><input type="submit" value="Supprimer" name="Supprimer"/>&nbsp;&nbsp;
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
           </tr>
           <tr height="30" valign="top"><!--BOUTONS-->
                <td colspan="2">
                    <center>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td valign="top"><input type="button" onclick="click_devis = 1; document.location.href='FPDI/<?php echo $liendevis; ?>.php?IdDevis=<?php echo $devis_id_get ;?>'" value="<?php echo $nomliendevis; ?>"/>&nbsp;&nbsp;</td>
                                <td valign="top"><input type="button" onclick="document.location.href='FPDI/gen_info.php?IdDevis=<?php echo $devis_id_get ;?>'" value="Imprimer informations"/>&nbsp;&nbsp;</td>
                                <td valign="top"><input type="button" onclick="click_consentement = 1; document.location.href='FPDI/gen_cons.php?IdDevis=<?php echo $devis_id_get ;?>'" value="Imprimer consentement"/>&nbsp;&nbsp;</td>
							</tr>
                        </table>
                    </center>
                </td>
           </tr>
		   
		   <!-- FICHES D'INFORMATIONS -->
           <tr height="30">
                <td colspan="2">
                    <center>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
								<td valign="top">
									<b style="margin-left:25px">Fiches d'informations &agrave; joindre :</b><br>
									<img src="images/plus.jpg" align="top" border="0" style="cursor:pointer; position:relative; top:1px; left:-5px" onclick="ajout_fiche()">
									<select id="fiche">
										<?php include 'liste_fiches.php' ?>
									</select>
									<img src="images/imprimer.jpg" align="top" border="0" style="cursor:pointer; position:relative; top:-4px; left:7px" onclick="imprimer()">
									<img src="images/mail.jpg" align="top" border="0" height="28" style="cursor:pointer; position:relative; top:-3px; margin-left:13px"
									onclick="mail(<?php echo "'".$sqldataPatient['Civilite'].' '.strtoupper($sqldataPatient['Nom'])."','".$devis_id_get."','".$sqldataPatient['Mail']."'" ?>)">
								</td>								
                            </tr>
							<!-- Fiche 2 -->
							<tr><td valign="top"><select id="fiche2" style="position:relative; top:-3px; left:24px; display:none"><?php include 'liste_fiches.php' ?></select></td></tr>
							<!-- Fiche 3 -->
							<tr><td valign="top"><select id="fiche3" style="position:relative; left:24px; display:none"><?php include 'liste_fiches.php' ?></select></td></tr>							
                        </table>
                    </center>
                </td>
           </tr>
		   
		   <!-- ORDONNANCES -->
           <tr height="30">
                <td colspan="2">
					<table cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td valign="top">
								<b style="margin-left:25px">Ordonnances &agrave; joindre :</b><br>
								<img src="images/plus.jpg" align="top" border="0" style="cursor:pointer; position:relative; top:1px; left:-5px" onclick="ajout_ordonnance()">
								<select id="ordonnance1" style="width:160px">
									<?php include 'liste_ordonnances.php' ?>
								</select>
								<input type="button" value="G&eacute;n&eacute;rer" onclick="generer_ordonnance('1',<? echo "'".$_GET['PatientId']."'" ?>)">
							</td>								
						</tr>
						<!-- Ordonnance 2 -->
						<tr>
							<td valign="top"><select id="ordonnance2" style="position:relative; top:0px; left:24px; width:160px; display:none"><?php include 'liste_ordonnances.php' ?></select>
							<input type="button" id="ordonnance2bouton" value="G&eacute;n&eacute;rer" style="display:none; position:relative; left:28px" onclick="generer_ordonnance('2',<? echo "'".$_GET['PatientId']."'" ?>)"></td>
						</tr>
						<!-- Ordonnance 3 -->
						<tr>
							<td valign="top"><select id="ordonnance3" style="position:relative; left:24px; width:160px; display:none"><?php include 'liste_ordonnances.php' ?></select>
							<input type="button" id="ordonnance3bouton" value="G&eacute;n&eacute;rer" style="display:none; position:relative; left:28px" onclick="generer_ordonnance('3',<? echo "'".$_GET['PatientId']."'" ?>)"></td>
						</tr>							
					</table>
                </td>
           </tr>		   
		 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 		 
		<script>
			var click_devis = 0;
			var click_consentement = 0;
			var click_ordonnance1 = 0;
			var click_ordonnance2 = 0;
			var click_ordonnance3 = 0;
			var erreur = "";
			var nb_fiches = 1;
			var nb_ordonnances = 1;
			
			function ajout_fiche()
			{
				if (nb_fiches == 3) return;
				nb_fiches++;
				$('#fiche'+nb_fiches).show();
			}
			
			function ajout_ordonnance()
			{
				if (nb_ordonnances == 3) return;
				nb_ordonnances++;
				$('#ordonnance'+nb_ordonnances).show();
				$('#ordonnance'+nb_ordonnances+'bouton').show();
			}
			
			function generer_ordonnance(position,patient_id)
			{				
				if (position == 1)
				{
					ordonnance1 = $('#ordonnance1').val();
					document.location.href = 'FPDI/gen_ordo.php?type_ordo='+ordonnance1+'&PatientID='+patient_id;
					click_ordonnance1 = 1;
				}
				else if (position == 2)
				{
					ordonnance2 = $('#ordonnance2').val();
					document.location.href = 'FPDI/gen_ordo.php?type_ordo='+ordonnance2+'&PatientID='+patient_id;
					click_ordonnance2 = 1;
				}
				else if (position == 3)
				{
					ordonnance3 = $('#ordonnance3').val();
					document.location.href = 'FPDI/gen_ordo.php?type_ordo='+ordonnance3+'&PatientID='+patient_id;
					click_ordonnance3 = 1;
				}	
			}
			
			function mail(nom,id_devis,email)
			{
				if (click_devis == 0) erreur += "- Vous devez d'abord g\u00E9n\u00E9rer le devis avant d'envoyer le mail.\n";
				if (click_consentement == 0) erreur += "- Vous devez d'abord g\u00E9n\u00E9rer le consentement mutuel avant d'envoyer le mail.\n";
				if (click_ordonnance1 == 0) erreur += "- Vous devez d'abord g\u00E9n\u00E9rer l'ordonnance n\u00B01 avant d'envoyer le mail.\n";
				if ((nb_ordonnances == 2 || nb_ordonnances == 3) && click_ordonnance2 == 0) erreur += "- Vous devez d'abord g\u00E9n\u00E9rer l'ordonnance n\u00B02 avant d'envoyer le mail.\n";
				if (nb_ordonnances == 3 && click_ordonnance3 == 0) erreur += "- Vous devez d'abord g\u00E9n\u00E9rer l'ordonnance n\u00B03 avant d'envoyer le mail.\n";
				if (erreur != "")
				{
					alert(erreur);
					erreur = "";
					return;
				}
				else
				{
					// Fiches
					fiche = $('#fiche').val();
					if ($('#fiche2').css('display') != 'none') fiche2 = $('#fiche2').val(); else fiche2 = '';
					if ($('#fiche3').css('display') != 'none') fiche3 = $('#fiche3').val(); else fiche3 = '';
					
					// Ordonnances
					ordonnance1 = $('#ordonnance1').val();
					if ($('#ordonnance2').css('display') != 'none') ordonnance2 = $('#ordonnance2').val(); else ordonnance2 = '';
					if ($('#ordonnance3').css('display') != 'none') ordonnance3 = $('#ordonnance3').val(); else ordonnance3 = '';
					
					var expediteur = prompt("Pr\u00E9cisez qui est l'auteur du mail (appara\u00EEtra au bas de celui-ci) :");
					if (expediteur == null) return;
					var expediteur_mail = prompt("Pr\u00E9cisez l'adresse e-mail de l'auteur :");
					if (expediteur_mail == null) return;
					$.get("mail.php", {nom:nom,id_devis:id_devis,fiche:fiche,fiche2:fiche2,fiche3:fiche3,ordonnance1:ordonnance1,ordonnance2:ordonnance2,ordonnance3:ordonnance3,email:email,expediteur:expediteur,expediteur_mail:expediteur_mail}, function(data)
					{
						alert('Le mail a bien \u00E9t\u00E9 envoy\u00E9.');
					});
				}
			}
		
			function imprimer()
			{
				fiche = $('#fiche').val();
				switch (fiche)
				{
					case 'chirurgie1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/23_chirurgie_des_petites_levres.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/18_lifting_face_interne_cuisse.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie3' : window.open("http://www.plasticiens.fr/fiches_informations/francais/9_lifting_fronto_temporal_endoscopique.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie4' : window.open("http://www.plasticiens.fr/fiches_informations/francais/2_ge%81nioplastie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie5' : window.open("http://www.plasticiens.fr/fiches_informations/francais/24_pe%81noplastie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie6' : window.open("http://www.plasticiens.fr/fiches_informations/francais/4_ble%81pharoplastie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie6en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A3_Cosmetic_blepharoplasty.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie7' : window.open("http://www.plasticiens.fr/fiches_informations/francais/17_body_lift.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie8' : window.open("http://www.plasticiens.fr/fiches_informations/francais/10_chirurgie_de_la_calvitie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie9' : window.open("http://www.plasticiens.fr/fiches_informations/francais/3_chirurgie_des_oreilles_decollees.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie9en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A2_Prominent_ears_surgery.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie10' : window.open("http://www.plasticiens.fr/fiches_informations/francais/1_rhinoplastie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie10en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A1_Rhinoplasty_cosmetic_nose_surgery","Impression","width=600, height=800"); break;
					case 'chirurgie11' : window.open("http://www.plasticiens.fr/fiches_informations/francais/5_lifting_cervico_facial.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie11en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A4%20_Face_lift.pdf","Impression","width=600, height=800"); break;			
					case 'chirurgie12' : window.open("http://www.plasticiens.fr/fiches_informations/francais/6_Lifting_temporal_non_endoscopique.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie13' : window.open("http://www.plasticiens.fr/fiches_informations/francais/7_Lifting_centro_facial.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie14' : window.open("http://www.plasticiens.fr/fiches_informations/francais/8_lifting_facial_sous_endoscopie.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie14en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A12_Endoscopic_forehead_lifts.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie15' : window.open("http://www.plasticiens.fr/fiches_informations/francais/16_CPE_paroi_abdominale.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie15en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A7_Abdominal_wall_plastic_and_aesthetic_surgery.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie16' : window.open("http://www.plasticiens.fr/fiches_informations/francais/19_Lifting_de_la_face_interne_du_bras.pdf","Impression","width=600, height=800"); break;
					case 'chirurgie16en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A10_Arm_inner_side_lifting.pdf","Impression","width=600, height=800"); break;
					
					case 'chirurgiemain1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/40_Le_kyste_synovial.pdf","Impression","width=600, height=800"); break;
					case 'chirurgiemain2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/41_maladie_de_dupuytren.pdf","Impression","width=600, height=800"); break;
					case 'chirurgiemain3' : window.open("http://www.plasticiens.fr/fiches_informations/francais/42_syndrome_canal_carpien.pdf","Impression","width=600, height=800"); break;
					
					case 'chirurgieplastique1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/26_chirurgie_des_tumeurs_cutane%81es.pdf","Impression","width=600, height=800"); break;
					case 'chirurgieplastique2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/25_chirurgie_cutane%81e.pdf","Impression","width=600, height=800"); break;
					
					case 'cmf' : window.open("http://www.plasticiens.fr/fiches_informations/francais/43_kystes_et_fistules_de_la_partie_late%81rale_du_cou.pdf","Impression","width=600, height=800"); break;
					
					case 'esthetique1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/28_acide_hyaluronique.pdf","Impression","width=600, height=800"); break;
					case 'esthetique2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/27_Injections_de_produits_de_comblement.pdf","Impression","width=600, height=800"); break;
					case 'esthetique2en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A11_The_botulinic_toxin.pdf","Impression","width=600, height=800"); break;
					case 'esthetique3' : window.open("http://www.plasticiens.fr/fiches_informations/francais/30_dermabrasion.pdf","Impression","width=600, height=800"); break;
					case 'esthetique4' : window.open("http://www.plasticiens.fr/fiches_informations/francais/31_Peelings_du_visage.pdf","Impression","width=600, height=800"); break;
					case 'esthetique5' : window.open("http://www.plasticiens.fr/fiches_informations/francais/32_Abrasion_visage_par_laser.pdf","Impression","width=600, height=800"); break;
					case 'esthetique6' : window.open("http://www.plasticiens.fr/fiches_informations/francais/20_lipoaspiration.pdf","Impression","width=600, height=800"); break;
					case 'esthetique6en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A8_Liposuction.pdf","Impression","width=600, height=800"); break;
					
					case 'gyneco' : window.open("http://www.plasticiens.fr/fiches_informations/francais/15_gyne%81comastie.pdf","Impression","width=600, height=800"); break;
					case 'gynecoen' : window.open("http://www.plasticiens.fr/fiches_informations/english/A6_Breast_lift_mastopexy.pdf","Impression","width=600, height=800"); break;
					
					case 'seins1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/33_Reconstruction_du_sein_par_prothese.pdf","Impression","width=600, height=800"); break;
					case 'seins2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/34_Reconstruction_du_sein_par_grand_dorsal.pdf","Impression","width=600, height=800"); break;
					case 'seins3' : window.open("http://www.plasticiens.fr/fiches_informations/francais/35_reconstruction_sein_grand_droit_abdomen.pdf","Impression","width=600, height=800"); break;
					case 'seins4' : window.open("http://www.plasticiens.fr/fiches_informations/francais/36_Reconstruction_du_sein_par_lambeau_DIEP.pdf","Impression","width=600, height=800"); break;
					case 'seins5' : window.open("http://www.plasticiens.fr/fiches_informations/francais/13_protheses_mammaires.pdf","Impression","width=600, height=800"); break;
					case 'seins5en' : window.open("http://www.plasticiens.fr/fiches_informations/english/A5_Mammary_implants_and_breast_hypophasia.pdf","Impression","width=600, height=800"); break;
					case 'seins6' : window.open("http://www.plasticiens.fr/fiches_informations/francais/37_reconstruction_plaque_aerolo_mamelonnaire.pdf","Impression","width=600, height=800"); break;
					
					case 'transferts1' : window.open("http://www.plasticiens.fr/fiches_informations/francais/14_Tansfert_graisseux_%20augmentation_mammaire_a_visee_esthetique_ou_malformations_congenitales.pdf","Impression","width=600, height=800"); break;
					case 'transferts2' : window.open("http://www.plasticiens.fr/fiches_informations/francais/39_Transfert_graisseux_pour_la_correction_des_sequelles_du_traitement_conservateur_du_cancer_du_sein.pdf","Impression","width=600, height=800"); break;
					case 'transferts3' : window.open("http://www.plasticiens.fr/fiches_informations/francais/38_Transfert_graisseux_pour_reconstruction_mammaire_apr%e8s_mastectomie_totale.pdf","Impression","width=600, height=800"); break;
				}
			}
		</script>
		   
		</table>
		
		<br>
	
<!--FICHE Devis-->
	<table width="600" cellpadding="3" cellspacing="3" border="0">
		<tr>
            <td width="150">
                <label>Nom du patient</label> : 
            </td>
            <td>
                <?php echo strtoupper($sqldataPatient['Nom'])." ". ucfirst(strtolower($sqldataPatient['Prenom'])) ?>
            </td>
        </tr>    
		<tr> <!--TYPE DEVIS-->
		   <td width="250"><label for="typedevis">Type de devis</label> : </td>
		   <td>
           		<?php echo $Type; ?>
           </td>
	   </tr>
   		<tr><!--NATURE INTERVENTION-->
		   <td><label for="natureint">Nature de l'intervention</label> : </td>
		   <td>
           		<?php echo $sqldata['Nat_Int']; ?>
           </td>
	   <tr>
	   
	   <tr> <!--ANESTHESIE-->
		   <td width="250"><label for="anesthesie">Anesth&eacute;sie</label> : </td>
		   <td>
           		<?php echo $sqldata['Anesthesie']; ?>
           </td>
	   </tr>
	   
	   <tr><!--DATE PREMIERE CONSULTATION-->
		   <td><label for="datepremcons">Date premi&egrave;re consultation</label> : </td>
		   <td>
           		<?php echo $sqldata['Date_Prem_Cons']; ?>
           </td>
	   </tr>
       
       <tr><!--DATE INTERVENTION-->
		   <td><label for="dateint">Date intervention</label> : </td>
		   <td>
           		<?php echo $sqldata['Date_Int']; ?>
           </td>
	   </tr>
       
        <tr><!--HEURE INTERVENTION-->
		   <td><label for="heureint">Heure intervention</label> : </td>
		   <td>
           		<?php echo $sqldata['Heure_Int']; ?>
           </td>
	   </tr>
	   
	   <tr><!--FRAIS CH-->
		   <td><label for="fraisch">Frais de clinique et d'hospitalisation</label> : </td>
		   <td>
           		<?php echo $sqldata['FraisCH']; ?>&nbsp;&euro;
           </td>
	   <tr>
       
       <tr><!--FRAIS HCHT -->
		   <td><label for="fraishcht">Honoraires du chirurgien (HT)</label> : </td>
		   <td>
           		<?php echo $sqldata['FraisHC']; ?>&nbsp;&euro;
           </td>
	   <tr>
<?php
$hcht=$sqldata['FraisHC'];
$hctva=round($hcht*0.2);
$hcttc=round($hcht*1.2);
?> 	   
       <tr><!--FRAIS HCTVA-->
		   <td><label for="fraishctva">Honoraires du chirurgien (TVA)</label> : </td>
		   <td>

           		<?php echo $hctva; ?>&nbsp;&euro;
           </td>
	   <tr>
	   
       <tr><!--FRAIS HCTTC-->
		   <td><label for="fraishcttc">Honoraires du chirurgien (TTC)</label> : </td>
		   <td>
           		<?php echo $hcttc; ?>&nbsp;&euro;
           </td>
	   <tr>
       
       <tr><!--AIDE OP-->
		   <td><label for="aideop">Aide op&eacute;ratoire</label> : </td>
		   <td>
           		<?php echo $sqldata['AideOp']; ?>&nbsp;&euro;
           </td>
	   <tr>
       
       <tr><!--FRAIS HA-->
		   <td><label for="fraisha">Frais des honoraires de l'anesth&eacute;siste</label> : </td>
		   <td>
           		<?php echo $sqldata['FraisHA']; ?>&nbsp;&euro;
           </td>
	   <tr>
       
       <tr><!--FRAIS MATERIEL-->
		   <td><label for="fraismat">Mat&eacute;riel implant&eacute;</label> : </td>
		   <td>
           		<?php echo $sqldata['FraisMat']; ?>&nbsp;&euro;
           </td>
	   <tr>
	   
	   <tr><!--CODE CCAM-->
		   <td><label for="ccam">Code CCAM</label> : </td>
		   <td>
           		<?php echo $sqldata['Code_CCAM']; ?>
           </td>
	   </tr>
       
       <tr> <!--CLINQUE-->
		   <td width="250">
                <label for="clinique">Clinique</label> : 
            </td>
            <td>
           		<?php echo $sqldataCli['Clinique']; ?>
           </td>
	   </tr>
       
       <tr><!--DATE ETAB-->
		   <td><label for="dateetab">Date devis</label> : </td>
		   <td>
           		<?php echo $sqldata['Date_Etab']; ?>
           </td>
	   </tr>
	   
	   <tr height="60" valign="bottom"><!--BOUTONS-->
                <td colspan="2">
                    <center>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td valign="top"><input id="bouton_devis" type="button" onclick="click_devis = 1; document.location.href='FPDI/<?php echo $liendevis; ?>.php?IdDevis=<?php echo $devis_id_get ;?>'" value="<?php echo $nomliendevis; ?>"/>&nbsp;&nbsp;</td>
                                <td valign="top"><input type="button" onclick="document.location.href='FPDI/gen_info.php?IdDevis=<?php echo $devis_id_get ;?>'" value="Imprimer informations"/>&nbsp;&nbsp;</td>
                                <td valign="top"><input type="button" onclick="click_consentement = 1; document.location.href='FPDI/gen_cons.php?IdDevis=<?php echo $devis_id_get ;?>'" value="Imprimer consentement"/>&nbsp;&nbsp;</td>
                            </tr>
                        </table>   
                            </tr>
                        </table>
                    </center>
                </td>
           </tr>			
           <tr height="30"><!--BOUTONS-->
                <td colspan="2">
                    <center>
                    	<table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td valign="top"><input type="button" onclick="redirModifDevis()" value="Modifier" name="modifInfo"/>&nbsp;&nbsp;</td>
                                <td>
                                    <form method="post" onSubmit="return confirm('Etes-vous s&ucirc;r de vouloir supprimer ce devis ?')">
                                        <input type="hidden" name="DevisID" value="<?php echo $sqldata['Id']; ?>" ><input type="submit" value="Supprimer" name="Supprimer"/>&nbsp;&nbsp;
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
           </tr>
	   
	   <tr>
	   	<td id="ancre" colspan="2"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
   </table>
   
</div>
	
<?php
include("footer.html");
mysql_close();
?>