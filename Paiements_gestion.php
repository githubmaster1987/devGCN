<?php
	session_start(); // On relaye la session
	Require("connexionBDD.php");
	Require("Auth.inc.php");
	include("header.html");
	function date_fr($date) { return substr($date,8,2).'/'.substr($date,5,2).'/'.substr($date,0,4); }
?>
 
<div id="content" style="background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:806;">
	<table width="806" cellpadding="0" cellspacing="0">
		<tr height="60px">
	   		<td colspan="3" valign="top"><center><h3>Gestion paiements</h3></center></td>	
	   	</tr>
	</table>
	
	<center><a target="_blank" href="Paiements.xls"><img src="images/excel.png"><br/>T&eacute;l&eacute;charger le fichier Excel</a></center>
	
	<!-- Librairie DataTables -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script> 
	<link rel="stylesheet" href="DataTables-1.8.0/media/css/demo_table.css" type="text/css" />
	<script type="text/javascript" language="javascript" src="DataTables-1.8.0/media/js/jquery.dataTables.js"></script>
	
	<!-- Formulaire -->
	<div id="formulaire" style="border:solid 0px; text-align:right; width:450px; margin-left:50px; display:none">
		Patient : <input id="patient" type="text" style="width:158px"><br>
		Date : <input id="date" type="text" style="width:158px"><br>
		Type : <select id="type" style="width:163px"><option value="Consultation">Consultation</option><option value="Injection">Injection</option><option value="Chirurgie">Chirurgie</option></select><br>
		Moyen de paiement : <select id="moyendepaiement" style="width:163px"><option value="Especes">Especes</option><option value="Cheque">Cheque</option><option value="Carte bancaire">Carte bancaire</option></select><br>
		Montant : <input id="montant" type="text">&euro;<br>
		<input type="button" value="Modifier" style="cursor:pointer; width:100px; margin-top:10px; margin-right:30px" onclick="modifier()">
		<br>
	</div>
	
	<br><br><br>
	
	<!-- Table -->
	<div style="border:solid 0px; position:relative; top:-20px; left:20px; width:760px">
			<table cellpadding="4" cellspacing="0" border="0" class="display" style="width:760px; padding-top:10px" id="table_paiements">
			<thead>
				<tr style="font-size:12px">
					<th style="font-weight:bold">Patient</th>
					<th style="font-weight:bold">Date</th>
					<th style="font-weight:bold">Type</th>
					<th style="font-weight:bold">Moyen de paiement</th>
					<th style="font-weight:bold">Montant</th>
					<th style="font-weight:bold">Modifier</th>
					<th style="font-weight:bold">Supprimer</th>
				</tr> 
			</thead>
							
			<tbody style="font-size:12px">
				<?php
					$request = "SELECT * FROM paiements ORDER BY date DESC";
					$data = mysql_query($request);
					
					while($datas = mysql_fetch_array($data))
					{
						?>
						<tr class="odd gradeB" style="cursor:pointer">
							<td class="center" ><?php echo stripslashes($datas['nom']) ?></td>
							<td class="center" ><?php echo date_fr($datas['date']) ?></td>
							<td class="center" ><?php echo $datas['type'] ?></td>
							<td class="center" ><?php echo $datas['moyendepaiement'] ?></td>
							<td class="center" ><?php echo $datas['montant'].' &euro;' ?></td>
							<td class="center"><a href="javascript:get(<?php echo $datas['id'] ?>)"><img src="images/modification.png" border="0"></a></td>				
							<td class="center"><a href="javascript:supprimer(<?php echo "'".$datas['id']."','".$datas['nom']."','".date_fr($datas['date'])."'" ?>)"><img src="images/suppression.png" border="0"></a></td>					
						</tr>
						<?php } ?>
			</tbody>
			</table>
	</div>
	
	<table width="806" cellpadding="0" cellspacing="0"></table>
</div>

<?php
include("footer.html");
?>

<script>
	var id_current = -1;
	
	$(document).ready(function()
	{
		$('#table_paiements').dataTable(
		{
			"bAutoWidth":false
		});
	});
	
	function supprimer(id,patient,date)
	{
		if (confirm('Supprimer le paiement de '+patient+' du '+date+' ?'))
		$.get("Paiements_suppression.php",{id:id},function(data)
		{
			window.location.reload();
		});
	}
	
	function get(id)
	{
		id_current = id;
		$.get("Paiements_get.php",{id:id},function(data)
		{
			$('#patient').val(data.patient);
			$('#date').val(data.date);
			$('#type').val(data.type);
			$('#moyendepaiement').val(data.moyendepaiement);
			$('#montant').val(data.montant);
			$('#formulaire').slideDown('slow');
		},"json");
	}
	
	function modifier()
	{
		patient = $('#patient').val();
		date = $('#date').val();
		type = $('#type').val();
		moyendepaiement = $('#moyendepaiement').val();
		montant = $('#montant').val();
		$.get("Paiements_modification.php",{id:id_current,patient:patient,date:date,type:type,moyendepaiement:moyendepaiement,montant:montant},function(data)
		{
			window.location.reload();
		});
	}
</script>