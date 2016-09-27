<?php
 include("JSON.php");

 function mkdirs($dir, $mode = 0777, $recursive = true) {
  if( is_null($dir) || $dir === "" ){
    return "Empty Directory";
  }
  if( is_dir($dir) || $dir === "/" ){
    return "Directory Exists";
  }
  if( mkdirs(dirname($dir), $mode, $recursive) ){
    return mkdir($dir, $mode);
  }
  return "Error";
}

$result = array();
$dossier = "../photospatients";
 
	// Fonction de redimensionnement d'image
	function redimage($file)
	{
		$size = getimagesize($file);
		if ($size[1] > 600)
		{ 
			$y = 600;
			$x = ($y * $size[0]) / $size[1];
		}	
		if ($size)
		{ 
			if ($size['mime'] == 'image/jpeg' )
			{
				$img_big = imagecreatefromjpeg($file);
				$img_new = imagecreate($x, $y); 
				$img_mini = imagecreatetruecolor($x, $y) or $img_mini = imagecreate($x, $y); 
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 
				imagejpeg($img_mini,$file);
			}
			elseif ($size['mime'] == 'image/png' )	
			{
				$img_big = imagecreatefrompng($file);
				$img_new = imagecreate($x, $y); 
				$img_mini = imagecreatetruecolor($x, $y) or $img_mini = imagecreate($x, $y);
				imagealphablending($img_mini, false);
				imagesavealpha($img_mini,true);
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 
				imagepng($img_mini,$file);
			}
			elseif ($size['mime'] == 'image/gif' )	
			{
				$img_big = imagecreatefromgif($file);
				$img_new = imagecreate($x, $y); 
				$img_mini = imagecreatetruecolor($x, $y) or $img_mini = imagecreate($x, $y); 
				imagecopyresized($img_mini,$img_big,0,0,0,0,$x,$y,$size[0],$size[1]); 
				imagegif($img_mini,$file);
			}
		}
		return $file;
	}
	
if (isset($_FILES['photoupload']) )
{
	$file = $_FILES['photoupload']['tmp_name'];
	$error = false;
	$size = false;
	$size = @getimagesize($file);
	if (!is_uploaded_file($file) || ($_FILES['photoupload']['size'] > 15 * 1024 * 1024) )
	{
		$error = 'Please upload only files smaller than 15Mb!';
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
		Require("../connexionBDD.php");

		$id = $_GET['PatientId'];
		$extension=strrchr($_FILES['photoupload']['name'],'.');
		$fichierfin = $id."_".time().rand().$extension;
        //move_uploaded_file($file, $dossier."/".$fichierfin);

        $sub_dir = "";
        $dir_name = "";
        $dest_path = "";
		$cnt = 0;
		
		$queryPatients = "SELECT p.Nom, p.Prenom FROM  Patients p WHERE id=".$id;
		$queryPatientsResult = mysql_query($queryPatients);
		
		while ($result = mysql_fetch_array($queryPatientsResult)) {
		  if($cnt == 0)
		  {
		  	$sub_dir = $result["Nom"]."_".$result["Prenom"];
		  	$dir_name = $dossier."/".$sub_dir;
		  	mkdirs($dir_name);
		  	$dest_path = $dossier."/".$sub_dir."/".$fichierfin;
		  }
		}

		move_uploaded_file(redimage($file), $dest_path);
		$result['result'] = 'success';
		$result['size'] = "Upload ({$size['mime']}) avec  {$size[0]}px/{$size[1]}px.";
		
		$fichierfin = $sub_dir."/".$fichierfin;

		$sql = "INSERT INTO `PhotosPatients` (`IdPhoto`, `IdPatient`, `Nom`, `Lien`) VALUES (NULL, '".$id."', '".$_FILES['photoupload']['name']."', '".$fichierfin."');";
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