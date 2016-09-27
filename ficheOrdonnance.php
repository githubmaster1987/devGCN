<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

	
	$id = $_GET['PatientId'];
	if(!isset($_GET['PatientId']))
		{
			header("Location:index.php");
		}
	$sqlinfospatient = "SELECT Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
	$sqlresult = mysql_query($sqlinfospatient);
	$sqldata = mysql_fetch_array($sqlresult);
	
	$sql_ordo = "SELECT * FROM `Ordonnances`";
	$sqlresult_ordo = mysql_query($sql_ordo);

	include("header.html");
?>

		<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
			<center>
				<table border="0" cellspacing="0" cellpadding="0" >
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $id;?>" style="text-decoration:none;">Retour fiche patient</a></td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center><br/><br/>
			<center><h3>Creation d'ordonnance pour <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?></h3><br /><br /></center>
			<form action="FPDI/gen_ordo.php" method="post">
				<table>
					<tr>
						<td>
							Type d'ordonnace : 			
						</td>
						<td>
							<select name="type_ordo">
								<?php
								 	while($data_ordo = mysql_fetch_array($sqlresult_ordo)){
										
										echo "<option value='".$data_ordo['Id']."'>".$data_ordo['Nom']."</option>";
								 	}
								?>
							</select>	
						</td>
						<td>
							<input type="hidden" value="<?php echo $id; ?>" name="PatientID" />
							<input type="submit" value="G&eacute;n&eacute;rer" />
						</td>
					</tr>
				</table>
			</form>
				
		</div>

<?php
mysql_close();
include("footer.html");
?>