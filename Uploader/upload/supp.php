<?php
if(isset($_REQUEST['supp'])){
$chemin = $_REQUEST['supp']; 
$dir = opendir($chemin); 
while($file = readdir($dir)) { 
unlink(@$chemin . "/" . @$file); 
} 

closedir($dir); 

rmdir($chemin);
header("location:../index.php");
}
if(isset($_REQUEST['supp_img'])){
$filename = $_REQUEST['supp_img']; //nom de ton fichier ici.
unlink($filename);
//echo $filename;

//unlink("http://127.0.0.1/hartley/_mimi1405/uploaded/".$_REQUEST['supp_img']);
header("location:../contenu.php?dossier=".$_REQUEST['dossier']);
}
?>
