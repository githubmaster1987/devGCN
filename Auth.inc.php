<?

Require("AuthFonction.php");

if (session_is_registered(ReturnAuthFunction())){ // vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
}
else {
header("Location:Authentification.php?erreur=intru"); // redirection en cas d'echec
}




?>