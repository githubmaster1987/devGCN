<?php
Require("connexionBDD.php");
session_start(); // On relaye la session
Require("Auth.inc.php");

include("header.html");

$ligne = exec('du -h ../');
	$size = substr($ligne,0,(count($ligne) -6));
	$Type = substr($ligne,(count($ligne) -6),(count($ligne) -5));
	
	if($Type == "M")
	{
		$value = $size / 100003;
	}
	if($Type == "G")
	{
		$value = $size / 97.66;
	}
	
	$color = "#00FF00";
	if($value > 0.35)
	{
		$color = "green";	
	}
	if($value > 0.5)
	{
		$color = "#FFA500";	
	}
	if($value > 0.9)
	{
		$color = "red";	
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
		
		<tr height="120px">
	   		<td valign="top"><center><h3>Etat de la memoire.</h3></center></td>	
	   	</tr>
		<tr>
			<td style="text-align:center;" width="100%">
				<div><?php echo round($value * 100);?>%</div>
				<div style="width:500px;height:15px;border: 1px double black;" >
					<div style="width:<?php echo ($value * 500);?>px;height:13px;border: 1px double black;background-color:<?php echo $color; ?>" >
						
					</div>
				</div>
			</td>
		</tr>
	</table>

</div>
	

<?php
include("footer.html");

?>