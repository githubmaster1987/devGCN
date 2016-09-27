<?php
Require("../connexionBDD.php");

$queryPatients = "SELECT pp.*, p.Nom, p.Prenom FROM PhotosPatients pp
                  Left JOIN Patients p on pp.IdPatient = p.id";
$queryPatientsResult = mysql_query($queryPatients);
$cnt = 0;

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$path = "";
while ($result = mysql_fetch_array($queryPatientsResult)) {
  //if($cnt < 10)
  {
    $db_filename = $result["Lien"];
    $pos = strpos($db_filename, '/'); // $pos = 7, not 0
    if($pos > 0) continue;
    
    $sub_dir = $result["Nom"]."_".$result["Prenom"];
    $dir_path = "../photospatients/".$sub_dir;
    //echo $dir_path."<br/>";
    mkdirs($dir_path);
    $org_path = "photospatients/".$result["Lien"];
    $dest_path = "../photospatients/".$sub_dir."/".$result["Lien"];
    $path = $org_path;
    //echo $org_path."<br/>";
    //echo $dest_path."<br/>";
    rename($org_path, $dest_path);
    $cnt++;
  }
}

$updateSQL = "UPDATE `pbellity1`.`PhotosPatients` AS pp
            LEFT JOIN Patients AS p ON pp.IdPatient = p.Id
          SET pp.`Lien` = CONCAT(p.Nom, '_', p.Prenom, '/', pp.Lien)";
//echo $updateSQL;
$updateQuery = mysql_query($updateSQL);

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

$param = $_REQUEST['param'];

function showDir($str) {
    if (is_dir($str)) {
        $scan = glob(rtrim($str,'/').'/*');
        foreach($scan as $index=>$path) {
            echo $path."<br/>";
            showDir($path);
        }
    }
}
/*
if(!mkdirs("1"))
	echo "Failed";
*/
//showDir($rootPath."devGCM/photospatients");
?>