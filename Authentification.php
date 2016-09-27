<?php Require("connexionBDD.php"); ?>
<?php
/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/

session_start(); // d�but de session


if (isset($_POST['login'])){ // execution uniquement apres envoi du formulaire (test si la variable POST existe)
	$login = addslashes($_POST['login']); // mise en variable du nom d'utilisateur
	$pass = addslashes(md5($_POST['pass'])); // mise en variable du mot de passe chiffr� � l'aide de md5 (I love md5)
	
// requete sur la table administrateurs (on r�cup�re les infos de la personne)
$verif_query=sprintf("SELECT * FROM utilisateurs WHERE login='$login' AND pass='$pass'"); // requ�te sur la base administrateurs
$verif = mysql_query($verif_query) or die(mysql_error());
$row_verif = mysql_fetch_assoc($verif);
$utilisateur = mysql_num_rows($verif);

	
	if ($utilisateur) {	// On test s'il y a un utilisateur correspondant
		Require("AuthFonction.php");
	    session_register(ReturnAuthFunction()); // enregistrement de la session
		
		// d�claration des variables de session
		$_SESSION['privilege'] = $row_verif['privilege']; // le privil�ge de l'utilisateur (permet de d�finir des niveaux d'utilisateur)
		$_SESSION['nom'] = $row_verif['nom']; // Son nom
		$_SESSION['prenom'] = $row_verif['prenom']; // Son Pr�nom
		$_SESSION['login'] = $row_verif['login']; // Son Login
		//$_SESSION['pass'] = $row_verif['pass']; // Son mot de passe (� �viter)
		
		header("Location:index.php"); // redirection si OK
	}
	else {
		header("Location:Authentification.php?erreur=login"); // redirection si utilisateur non reconnu
	}
}


// Gestion de la  d�connexion
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ // Test sur les param�tres d'URL qui permettront d'identifier un contexte de d�connexion
	$prenom = $_SESSION['prenom']; // On garde le pr�nom en variable pour dire au revoir (soyons polis :-)
	session_unset("auth" . date('Y-m-d') . "GCM");
	header("Location:Authentification.php?erreur=delog&prenom=$prenom");
}
include("header.html");
?>

<body>
<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">

	<form action="" method="post" name="connect">
	  <p align="center" class="titre"><strong>- : ESPACE SECURISE : -</strong></p>
	  <p align="center" class="title">
	    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur  ?>
	    <strong class="erreur">Echec d'authentification !!! &gt; login ou mot de passe incorrect</strong>
	    <?php } ?>
	    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { // Affiche l'erreur ?>
	    <strong class="reussite">D&eacute;connexion r&eacute;ussie... A bient&ocirc;t <?php echo $_GET['prenom'];?> !</strong>
	    <?php } ?>
	    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) { // Affiche l'erreur ?>
	    <strong class="erreur">Echec d'authentification !!! &gt; Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page</strong>
	    <?php } ?>
	  </p>
	
	  
	  <table width="300"  border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#eeeeee" class="tableaux">
	    <tr>
	      <td width="50%""><div align="right">login</div></td>
	      <td width="50%"><input name="login" type="text" id="login"></td>
	    </tr>
	    <tr>
	      <td width="50%""><div align="right">mot de passe</div></td>
	      <td width="50%"><input name="pass" type="password" id="pass"></td>
	    </tr>
	    <tr>
	      <td height="34" colspan="2"><div align="center">
	          <input type="submit" name="Submit" value="Se connecter">
	      </div></td>
	    </tr>
	  </table>
	</form>
</div>
<?php
include("footer.html");
?>
