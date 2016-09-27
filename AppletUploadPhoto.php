<?php 





Require("connexionBDD.php");

		
$sqlinfospatient = "SELECT Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);



$id = $_GET['PatientId'];



	
	
	include("header.html");
?>
		<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
			<center>
				<table border="0" cellspacing="0" cellpadding="0" >
				    <tr>
				        <td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
				        <td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ficheVierge.php" style="text-decoration:none;">Nouvelle fiche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="recherche.php" style="text-decoration:none;">Recherche</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="fichePatient.php?PatientID=<?php echo $id;?>" style="text-decoration:none;">Retour fiche patient</a>
						&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="ManagePhoto.php?PatientId=<?php echo $id;?>" style="text-decoration:none;">Retour Photo Manager</a>
						</td>
				        <td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
				    </tr>
				</table>
	   		</center><br/><br/>
			<center><h3>Upload photos de <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?></h3><br /><br /></center>
			
	
			<applet
		title="JUpload"
		name="JUpload"
		code="com.smartwerkz.jupload.classic.JUpload"
		codebase="."
		archive="JuploadPhoto/dist/jupload.jar,
				JuploadPhoto/dist/commons-codec-1.3.jar,
				JuploadPhoto/dist/commons-httpclient-3.0-rc4.jar,
				JuploadPhoto/dist/commons-logging.jar,
				JuploadPhoto/dist/skinlf/skinlf-6.2.jar"
		width="640"
		height="480"
		mayscript="mayscript"
		alt="JUpload by www.jupload.biz">

		<param name="Config" value="JuploadPhoto/cfg/jupload.default.config">
		<param name="Upload.URL.Action" value="JuploadPhoto/scripts/php/jupload-post.php?PatientId=<?php echo $id; ?>">

		</applet>
			
		</div>

<?php
mysql_close();
include("footer.html");
?>