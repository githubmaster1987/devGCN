<?

Require("AuthFonction.php");

if (session_is_registered(ReturnAuthFunction())){ // v�rification sur la session authentification (la session est elle enregistr�e ?)
// ici les �ventuelles actions en cas de r�ussite de la connexion
}
else {
header("Location:Authentification.php?erreur=intru"); // redirection en cas d'echec
}




?>