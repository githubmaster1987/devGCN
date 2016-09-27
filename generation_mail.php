<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

include("header.html");


//requete pour recuperer toutes les adresses e-mail
function VerifierAdresseMail($adresse)
{
   $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';
   if(preg_match($Syntaxe,$adresse))
      return true;
   else
     return false;
}

	$queryMail = "SELECT * FROM Patients;";
if(isset($_GET['recherche']))
{
	if($_GET['RechercheType'] == 1)
	{
		$queryMail = "SELECT * FROM `Patients` WHERE `Notes` LIKE '%".$_GET['recherche']."%' ORDER BY Nom ;";
	}else
	{
		$queryMail = "SELECT * FROM `Patients` WHERE `Nom` LIKE '".$_GET['recherche']."%' ORDER BY Nom ;";
	}
};

				

$queryMailResult = mysql_query($queryMail);
while($sqldata = mysql_fetch_array($queryMailResult)){
if(VerifierAdresseMail($sqldata['Mail']))
	{
		$touteslesadressesmails .=  $sqldata['Mail']."";
		$affiche[] = $sqldata['Mail']."<br />";
	}
	
}
?>
	
	
<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
		<table cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="3"><center>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="12"><img src="images/menuGCM_gch.png" width="12" height="27" border="0" /></td>
							<td id="menu" valign="middle" background="images/menuGCM_centre.png" height="27" style="background-repeat:repeat-x;"><a href="index.php" style="text-decoration:none;">Index</a>&nbsp;&nbsp;<font style="color:#5782af;">|</font>&nbsp;&nbsp;<a href="administration.php" style="text-decoration:none;">Retour page administration</a></td>
							<td width="12"><img src="images/menuGCM_drt.png" width="12" height="27" border="0" /></td>
						</tr>
					</table>
	   	</center></td>
			</tr>
   
		</table>
   
   

	<table width="500" cellpadding="0" cellspacing="0">
		
		<tr height="60px">
	   		<td valign="top"><center><h3>Adresses Mails</h3></center></td>	
	   	</tr>
		<!--<tr height="35px">
	   		<td valign="top"><a href="mailto:?bcc=<?php echo $touteslesadressesmails; ?>">Envoyer le mail</a><br/></td>	
	   	</tr>-->
		<tr>
			<td>
				<fieldset>
				<legend><font style="color:#5782af;">Listes des adresses mails : </font></legend>
					<?php for($i=0;$i<sizeof($affiche);$i++){echo $affiche[$i];}  ?>
				</fieldset>
			</td>
		</tr>
		
		<tr>
	   	<td id="ancre"><a href="#haut_page" style="color:#5782af;text-decoration:none">Haut de page <img src="images/arrow_up.png" width="10" height="10" border="0"/></a></td>
	   </tr>
		
	</table>

</div>
	

<?php
include("footer.html");
mysql_close();
?>