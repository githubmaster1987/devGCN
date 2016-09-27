<?php
if(isset($_POST["go"])) {	
	while(list($k,$v)=each($_POST)) {
		$$k = $v;
	}
	mkdir($dossier);
	header("location:../index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mes images et cr&eacute;as</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
<fieldset style="width:700px; background-color:#cdcddf">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="formulaire">
	<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
	  <tr>
    <td>&nbsp;</td>
    <td align="center" class="Style3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" class="Style3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td align="center" class="Style3">&curren; NOUVEAU DOSSIER &curren;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><a href="../index.php" class="lien-contact">Retour &agrave; l'accueil</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="Style20" align="center">Dossier (sans espace)</td>
  </tr>
  <tr>
    <td align="center"><input name="dossier" type="text" id="dossier" value="<?php echo @$dossier; ?>" class="form" size="35"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input name="go" id="go"  type="submit" class="titre_form" value="Créer !" /></td>
  </tr>
</table>
	</form>
	</fieldset>
</div>
</body>
</html>