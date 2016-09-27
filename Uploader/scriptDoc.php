<?php
 include("JSON.php");
$result = array();
$dossier = "../docspatients";
 
if (isset($_FILES['photoupload']) )
{
	$file = $_FILES['photoupload']['tmp_name'];
	$error = false;
	$size = false;

	if (!is_uploaded_file($file) || ($_FILES['photoupload']['size'] > 150 * 1024 * 1024) )
	{
		$error = 'Please upload only files smaller than 150Mb!';
	}

 
	$addr = gethostbyaddr($_SERVER['REMOTE_ADDR']);
 
	$log = @fopen('script.log', 'a');
	@fputs($log, ($error ? 'FAILED' : 'SUCCESS') . ' - ' . preg_replace('/^[^.]+/', '***', $addr) . ": {$_FILES['photoupload']['name']} - {$_FILES['photoupload']['size']} byte\n" );
	@fclose($log);
 
	if ($error)
	{
		$result['result'] = 'failed';
		$result['error'] = $error;
	}
	else
	{
		$id = $_GET['PatientId'];
		$extension=strrchr($_FILES['photoupload']['name'],'.');
		$fichierfin = $id."_".time().rand().$extension;
        move_uploaded_file($file, $dossier."/".$fichierfin);
		$result['result'] = 'success';
		$result['size'] = "Upload ({$size['mime']})";
		
		Require("../connexionBDD.php");
		$sql = "INSERT INTO `DocPatients` (`IdDoc`, `IdPatient`, `Nom`, `Lien`) VALUES (NULL, '".$id."', '".$_FILES['photoupload']['name']."', '".$fichierfin."');";
		mysql_query($sql);
		mysql_close();
	}
 
}
else
{
	$result['result'] = 'error';
	$result['error'] = 'Missing file or internal error !';
}
 
if (!headers_sent() )
{
	header('Content-type: application/json');
}
 
echo json_encode($result);
 
?>