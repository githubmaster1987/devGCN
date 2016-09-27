<?php

$civ = "Monsieur";
$nom = "Lagier";
$prenom = "Francois";
$prof = "Informaticien";
$datenaissance = "23/09/1986";
$age = 22;
$add = "3 rue du maine";
$cp = "13320";
$ville = "BBA";
$pays = "France";
$lang = "Francais";
$mail = "cacou99@supinfo.com";
$tel_portable = "0123456789";
$tel_bureau = "1234567890";
$taille = "172";
$poids = "66";
$SecuSocial = "186789876544";

?>

<html>
	<head>
		<title>CRO</title>
		<script>
			function InsertText(str)
				{
					alert("ok");
					//insert("text",str,false);
				}
				
			function insert(box,text,modebb)
				  {
				  box = document.getElementById(box);
				  var str = box.value;
				  var msgstart = box.selectionStart,msgend = box.selectionEnd; // recupération de la position du curseur
				  var balise = text.split("]");
				  var balisedebut = balise[0] + "]",balisefin = balise[1] + "]"; //recuperation de la balise de debut et de fin
				  if(typeof msgstart == "undefined")// cas IE
				  {
				  	box.focus();
				  	var caretPos = document.selection.createRange().duplicate();
				  	if(!modebb)
				 	 caretPos.text = text; // modification du texte séléctionné
				  	else
				  	caretPos.text = balisedebut + caretPos.text + balisefin; // modification du texte séléctionné avec les balises
				 }
				  else // cas autre
				 {
				  	if(!modebb)
				 		box.value = str.substring(0,msgstart) + text + str.substring(msgend,str.length); // ajout simple a partir de la position du curseur
				  	else
				  		box.value = str.substring(0,msgstart) + balisedebut + str.substring(msgstart,msgend) + balisefin + str.substring(msgend,str.length); // ici je recupere le texte selectionné et ajoute une balise au début et à la fin
				  		box.setSelectionRange(msgstart+text.length,msgstart+text.length); // repositionne le curseur dans la textbox
				 }
				  box.focus();
				 } 
		</script>
	</head>
	<body>
		<h1>CRO</h1>
		
		<table border="1">
			<tr>
				<td>Civilit&eacute; : </td>
				<td><span style="pointer:curseur;" onclick="InsertText('<?php echo $nom; ?>')" ><?php echo $civ; ?></span></td>
				<td rows="17"><textarea name='text'></textarea></td>
			</tr>
			<tr>
				<td>Nom : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $nom; ?>')" ><?php echo $nom; ?></span></td>
			</tr>
			<tr>
				<td>Pr&eacute;nom : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $prenom; ?>')" ><?php echo $prenom; ?></span></td>
			</tr>
			<tr>
				<td>Profession : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $prof; ?>')" ><?php echo $prof; ?></span></td>
			</tr>
			<tr>
				<td>N&eacute; le : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $datenaissance; ?>')" ><?php echo $datenaissance; ?></span></td>
			</tr>
			<tr>
				<td>Age : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $age; ?> ans')" ><?php echo $age; ?> ans</span></td>
			</tr>
			<tr>
				<td>Adresse : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $add; ?>')" ><?php echo $add; ?></span></td>
			</tr>
			<tr>
				<td>CP : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $cp; ?>')" ><?php echo $cp; ?></span></td>
			</tr>
			<tr>
				<td>Ville : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $ville; ?>')" ><?php echo $ville; ?></span></td>
			</tr>
			<tr>
				<td>Pays : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $pays; ?>')" ><?php echo $pays; ?></span></td>
			</tr>
			<tr>
				<td>Langue : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $lang; ?>')" ><?php echo $lang; ?></span></td>
			</tr>
			<tr>
				<td>Email : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $mail; ?>')" ><?php echo $mail; ?></span></td>
			</tr>
			<tr>
				<td>Tel Portable : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $tel_portable; ?>')" ><?php echo $tel_portable; ?></span></td>
			</tr>
			<tr>
				<td>Tel Bureau : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $tel_bureau; ?>')" ><?php echo $tel_bureau; ?></span></td>
			</tr>
			<tr>
				<td>Taille : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $taille; ?>')" ><?php echo $taille; ?></span></td>
			</tr>
			<tr>
				<td>Poids : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $poids; ?> kgs')" ><?php echo $poids; ?> kgs</span></td>
			</tr>
			<tr>
				<td>N° SS : </td>
				<td><span style="pointer:curseur" onclick="InsertText('<?php echo $SecuSocial; ?>')" ><?php echo $SecuSocial; ?></span></td>
			</tr>			
		</table>
		
	</body>
</html>