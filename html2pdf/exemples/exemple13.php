<?php
/**
 * Logiciel : exemple d'utilisation de HTML2PDF
 * 
 * Convertisseur HTML => PDF, utilise fpdf de Olivier PLATHEY 
 * Distribué sous la licence GPL. 
 *
 * @author		Laurent MINGUET <webmaster@spipu.net>
 */
 	ob_start();
?>
	<style type="text/css">
	<!--
	td, th { width: 15mm; text-align: center; font-family: courier; }
	-->
	</style>
	Exemple de caracteres :<br>
	<table>
		<tr><th>0</th><th>a</th><th>e</th><th>i</th><th>o</th><th>u</th></tr>
		<tr><th>1</th><td>&agrave;</td><td>&egrave;</td><td>&igrave;</td><td>&ograve;</td><td>&ugrave;</td></tr>
		<tr><th>2</th><td>&aacute;</td><td>&eacute;</td><td>&iacute;</td><td>&oacute;</td><td>&uacute;</td></tr>
		<tr><th>3</th><td>&acirc;</td><td>&ecirc;</td><td>&icirc;</td><td>&ocirc;</td><td>&ucirc;</td></tr>
		<tr><th>4</th><td>&auml;</td><td>&euml;</td><td>&iuml;</td><td>&ouml;</td><td>&uuml;</td></tr>
		<tr><th>5</th><td>&atilde;</td><td> </td><td> </td><td>&otilde;</td><td> </td></tr>
		<tr><th>6</th><td>&aring;</td><td> </td><td> </td><td> </td><td> </td></tr>
		<tr><th>7</th><td> </td><td> </td><td> </td><td>&oslash;</td><td> </td></tr>
	</table>
	<br>
	<table>
		<tr><td>&euro;</td><td>&laquo;</td></tr>
		<tr><td>&#337;</td><td>&lsaquo;</td></tr>
	</table>
<?php
	$content = ob_get_clean();
	
	require_once(dirname(__FILE__).'/../html2pdf.class.php');
	$pdf = new HTML2PDF('P','A4','fr');
	$pdf->WriteHTML($content, isset($_GET['vuehtml']));
	$pdf->Output();
?>