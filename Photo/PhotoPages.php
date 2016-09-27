<?php 
include("../header.html");
$Nom = $_GET['nom'];
$Prenom = $_GET['prenom'];
$lien = $_GET['lien'];
$PhotoName = $_GET['photoname'];

?>


		<?php echo "Photo de " . $Nom . " " . $Prenom; ?><br />
		<img src="photospatients/<?php echo $lien; ?>"><br />
		Nom de la photo : <?php echo $PhotoName; ?>
		
		

<?php 
include("../footer.html");
?>