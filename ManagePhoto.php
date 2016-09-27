<?php 
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

	function Pair($Nombre)
		{
		    if ($nombre%2 == 0) return true;
		    else return false;
		}
		
$sqlinfospatient = "SELECT Nom, Prenom FROM Patients WHERE Id='".$_GET['PatientId']."'";
$sqlresult = mysql_query($sqlinfospatient);
$sqldata = mysql_fetch_array($sqlresult);
if($_GET['action'] == "del")
{
	unlink('photospatients/' . $_GET['lienphoto']);
	 $sql = "DELETE FROM `PhotosPatients` WHERE `PhotosPatients`.`IdPhoto` = ".$_GET['IdPhoto']." LIMIT 1";
	 mysql_query($sql);
	 
}


$id = $_GET['PatientId'];



if(!isset($_GET['PatientId']))
	{
		echo "ERREUR !!!";
	}
	

	$nom = "";
	$prenom = "";

	
	$sqlphoto = "SELECT p.Nom 'nompatient', p.Prenom, pp.IdPhoto, pp.Nom 'ImageName', pp.Lien"
        . " FROM `PhotosPatients` pp, `Patients` p"
        . " Where pp.IdPatient = p.Id"
        . " And pp.`IdPatient` = " . $id; 
	$resphoto = mysql_query($sqlphoto);

	while($dataphoto = mysql_fetch_array($resphoto))
	{
		$nom = $dataphoto['Nom'];
		$prenom = $dataphoto['Prenom'];
		$lien[] = "<a style=\"color:#5782af;\" href='PhotoPages.php?IdPhoto=" .$dataphoto['IdPhoto']."'><img src=\"photospatients/" .$dataphoto['Lien']."\" title=\"".$dataphoto['nompatient']. " " . $dataphoto['Prenom'] ."\" border=\"0\" width=\"100\" height=\"100\"></a>"; 
		$DelLien[] = "&nbsp;&nbsp;Supprimer : <a onclick=confirmDel('ManagePhoto.php?PatientId=".$id."&action=del&IdPhoto=".$dataphoto['IdPhoto']."&lienphoto=".$dataphoto['Lien']."') href='#'><img src=\"images/cancel.png\" title=\"Supprimer\" border=\"0\" width=\"16\" height=\"16\"></a>";
	} 
	
	
	include("header.html");
?>
	<style type="text/css">

#demo-status
{
	background-color:		#F9F7ED;
	padding:				10px 15px;
	width:					420px;
}

#demo-status .progress
{
	background:				white url(Uploader/img/progress.gif) no-repeat;
	background-position:	+50% 0;
	margin-right:			0.5em;
}

#demo-status .progress-text
{
	font-size:				0.9em;
	font-weight:			bold;
}

#demo-list
{
	list-style:				none;
	width:					450px;
	margin:					0;
}

#demo-list li.file
{
	border-bottom:			1px solid #eee;
	background:				url(Uploader/img/file.png) no-repeat 4px 4px;
}
#demo-list li.file.file-uploading
{
	background-image:		url(Uploader/img/uploading.png);
	background-color:		#D9DDE9;
}
#demo-list li.file.file-success
{
	background-image:		url(Uploader/img/success.png);
}
#demo-list li.file.file-failed
{
	background-image:		url(Uploader/img/failed.png);
}

#demo-list li.file .file-name
{
	font-size:				1.2em;
	margin-left:			44px;
	display:				block;
	clear:					left;
	line-height:			40px;
	height:					40px;
	font-weight:			bold;
}
#demo-list li.file .file-size
{
	font-size:				0.9em;
	line-height:			18px;
	float:					right;
	margin-top:				2px;
	margin-right:			6px;
}
#demo-list li.file .file-info
{
	display:				block;
	margin-left:			44px;
	font-size:				0.9em;
	line-height:			20px;
	clear
}
#demo-list li.file .file-remove
{
	clear:					right;
	float:					right;
	line-height:			18px;
	margin-right:			6px;
}
	</style>
	<script type="text/javascript" src="Uploader/js/mootools-1.2-core-nc.js"></script>
	<script type="text/javascript" src="Uploader/js/Swiff.Uploader.js"></script>
	<script type="text/javascript" src="Uploader/js/Fx.ProgressBar.js"></script>
	<script type="text/javascript" src="Uploader/js/FancyUpload2.js"></script>
	<script type="text/javascript">
		/* <![CDATA[ */

window.addEvent('load', function() {

	// For testing, showing the user the current Flash version.
	document.getElement('h3 + p').appendText(' Detected Flash ' + Browser.Plugins.Flash.version + '!');

	var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
		url: $('form-demo').action,
		fieldName: 'photoupload',
		path: 'Uploader/js/Swiff.Uploader.swf',
		limitSize: 15 * 1024 * 1024, // 15Mb
		onLoad: function() {
			$('demo-status').removeClass('hide');
			$('demo-fallback').destroy();
		},
		// The changed parts!
		debug: true, // enable logs, uses console.log
		target: 'demo-browse' // the element for the overlay (Flash 10 only)
	});

	/**
	 * Various interactions
	 */

	$('demo-browse').addEvent('click', function() {
		/**
		 * Doesn't work anymore with Flash 10: swiffy.browse();
		 * FancyUpload moves the Flash movie as overlay over the link.
		 * (see opeion "target" above)
		 */
		swiffy.browse();
		return false;
	});

	/**
	 * The *NEW* way to set the typeFilter, since Flash 10 does not call
	 * swiffy.browse(), we need to change the type manually before the browse-click.
	 */
	$('demo-select-images').addEvent('change', function() {
		var filter = null;
		if (this.checked) {
			filter = {'Images (*.jpg, *.jpeg, *.gif, *.png, *.JPG, *.JPEG, *.GIF, *.PNG)': '*.jpg; *.jpeg; *.gif; *.png; *.JPG; *.JPEG; *.GIF; *.PNG'};
		}
		swiffy.options.typeFilter = filter;
	});

	$('demo-clear').addEvent('click', function() {
		swiffy.removeFile();
		return false;
	});

	$('demo-upload').addEvent('click', function() {
		swiffy.upload();
		return false;
	});

});
		/* ]]> */
	</script>

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
			<center><h3>Gestion photos de <?php echo strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom'])) ?></h3><br /><br /></center>

		<div class="container" id="container" >
			<div class="span-16 column colborder" id="content" style="display:none;">
				<div class="project">
					<div class="right quiet" title="Other versions">&nbsp;</div>
					<br class="clear" />
				</div>
		</div>	
		<h3 style="display:none;">&nbsp;</h3>
		<p style="display:none;"></p>
		<div id="demo">

			<form action="Uploader/script.php?PatientId=<?php echo $id; ?>" method="post" enctype="multipart/form-data" id="form-demo">
				<fieldset id="demo-fallback">
					<legend>File Upload</legend>
					<p>
						Selected your photo to upload.<br />
						<strong>This form is just an example fallback for the unobtrusive behaviour of FancyUpload.</strong>
					</p>
					<label for="demo-photoupload">
						Upload Photos:
						<input type="file" name="photoupload" id="demo-photoupload" />
					</label>
				</fieldset>

				<div id="demo-status" class="hide">
					<p>
						<a href="#" id="demo-browse">Parcourir...</a> |
						<input type="checkbox" id="demo-select-images" /> Images seules |
						<a href="#" id="demo-clear">Vider la liste</a> |
						<a href="#" id="demo-upload">Uploader</a> |
						<a href="#" onclick="window.document.location.reload();">Rafraichir</a>
					</p>
					<div>
						<strong class="overall-title">Progression globale</strong><br />
						<img src="Uploader/img/bar.gif" class="progress overall-progress" />
					</div>
					<div>
						<strong class="current-title">Progression du fichier</strong><br />
						<img src="Uploader/img/bar.gif" class="progress current-progress" />
					</div>
					<div class="current-text"></div>
				</div>

				<ul id="demo-list"></ul>

			</form>
		</div>
	</div>
	<br />
			<!--<a href="AppletUploadPhoto.php?PatientId=<?php echo $id;?>">Upload multiple des photos</a> -->
			<?php 
			if(isset($erreur))
			{
				echo "<h3 style='color:red;'>Erreur : ". $erreur ."</h3>";
			}
			?>
			<br />
			<?php if(sizeof($lien) > 0)
			{
			?>
			<table width="450" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top">
						<table border="0" cellspacing="0" cellpadding="0">
						    
						        
									<?php
									for($i=0;$i<sizeof($lien);$i++) // tant que $i est inferieur au nombre d'éléments du tableau...
									{
										echo "<tr><td>".$lien[$i].$DelLien[$i]."<hr /></td></tr>";
									}
									
									?>
						        
						    
						</table>
					</td>
				</tr>
			</table>
			<?php
			}
			?>
			
		</div>

<?php
mysql_close();
include("footer.html");
?>