<?php
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
	
	$dirname = 'photospatients';
	$dir = opendir($dirname);
	while($file = readdir($dir))
	{
		if($file != '.' && $file != '..' && $file != '3192_1230068026..JPG' && $file != '2422_12832680671809394149.JPG' && $file != '2291_1227999734..JPG')
		{
			// A décommenter si besoin de redim
			/*$size = getimagesize($dirname.'/'.$file);
			if ($size[1] > 600)
			{
				echo $file.'<br>';
				$file_redim = redimage($dirname.'/'.$file);
			}*/
		}
	}
	closedir($dir);	
	
?>