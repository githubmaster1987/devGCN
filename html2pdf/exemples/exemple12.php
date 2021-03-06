<?php
/**
 * Logiciel : exemple d'utilisation de HTML2PDF
 * 
 * Convertisseur HTML => PDF, utilise fpdf de Olivier PLATHEY 
 * Distribu� sous la licence GPL. 
 *
 * @author		Laurent MINGUET <webmaster@spipu.net>
 */
	$chaine = 'test de texte assez long pour engendrer des retours � la ligne automatique...';
	$chaine.= ', r�p�titif car besoin d\'un retour � la ligne'; 
	$chaine.= ', r�p�titif car besoin d\'un retour � la ligne'; 
	$chaine.= ', r�p�titif car besoin d\'un retour � la ligne'; 
	$chaine.= ', r�p�titif car besoin d\'un retour � la ligne'; 
 	ob_start();
?>
<style type="text/css">
<!--
ul
{
	background:	#FFDDDD;
	border:		solid 1px #FF0000;
}

ol
{
	background:	#DDFFDD;
	border:		solid 1px #00FF00;
}

ul li
{
	background:	#DDFFAA;
	border:		solid 1px #AAFF00;
}

ol li
{
	background:	#AADDFF;
	border:		solid 1px #00AAFF;
}
-->
</style>
<page style="font-size: 12px">
	<ul style="list-style-type: disc; width: 80%">
		<li>
			Point 1 :<br><?php echo $chaine; ?> 
		</li>
		<li>
			Point 2 :<br><?php echo $chaine; ?> 
			<ul style="list-style-type: circle">
				<li>
					Point 1 :<br><?php echo $chaine; ?> 
				</li>
				<li>
					Point 2 :<br><?php echo $chaine; ?> 
					<ul style="list-style-type: square">
						<li>
							Point 1 :<br><?php echo $chaine; ?> 
						</li>
						<li>
							Point 2 :<br><?php echo $chaine; ?> 
						</li>
						<li>
							Point 3 :<br><?php echo $chaine; ?> 
						</li>
					</ul>
				</li>
				<li>
					Point 3 :<br><?php echo $chaine; ?> 
				</li>
			</ul>
		</li>
		<li>
			Point 3 :<br><?php echo $chaine; ?> 
		</li>
	</ul>
	<hr><hr>
	<ol style="list-style-type: upper-roman">
		<li>
			Point 1 :<br><?php echo $chaine; ?> 
		</li>
		<li>
			Point 2 :<br><?php echo $chaine; ?> 
			<ol style="list-style-type: lower-alpha">
				<li>
					Point 1 :<br><?php echo $chaine; ?> 
				</li>
				<li>
					Point 2 :<br><?php echo $chaine; ?> 
					<ol style="list-style-type: decimal">
						<li>
							Point 1 :<br><?php echo $chaine; ?> 
						</li>
						<li>
							Point 2 :<br><?php echo $chaine; ?> 
						</li>
						<li>
							Point 3 :<br><?php echo $chaine; ?> 
						</li>
					</ol>
				</li>
				<li>
					Point 3 :<br><?php echo $chaine; ?> 
				</li>
			</ol>
		</li>
		<li>
			Point 3 :<br><?php echo $chaine; ?> 
		</li>
	</ol>
</page>
<?php
	$content = ob_get_clean();
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$pdf = new HTML2PDF('P','A4','fr');
	$pdf->WriteHTML($content, isset($_GET['vuehtml']));
	$pdf->Output();
?>