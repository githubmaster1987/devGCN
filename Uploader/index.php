<?php 
$dossier = $_REQUEST['folder'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload d'images !</title>


	<style type="text/css">

#demo-status
{
	background-color:		#F9F7ED;
	padding:				10px 15px;
	width:					420px;
}

#demo-status .progress
{
	background:				white url(img/progress.gif) no-repeat;
	background-position:	+50% 0;
	margin-right:			0.5em;
}

#demo-status .progress-text
{
	font-size:				0.9em;
	font-weight:			bold;
}

#demo-list
{
	list-style:				none;
	width:					450px;
	margin:					0;
}

#demo-list li.file
{
	border-bottom:			1px solid #eee;
	background:				url(img/file.png) no-repeat 4px 4px;
}
#demo-list li.file.file-uploading
{
	background-image:		url(img/uploading.png);
	background-color:		#D9DDE9;
}
#demo-list li.file.file-success
{
	background-image:		url(img/success.png);
}
#demo-list li.file.file-failed
{
	background-image:		url(img/failed.png);
}

#demo-list li.file .file-name
{
	font-size:				1.2em;
	margin-left:			44px;
	display:				block;
	clear:					left;
	line-height:			40px;
	height:					40px;
	font-weight:			bold;
}
#demo-list li.file .file-size
{
	font-size:				0.9em;
	line-height:			18px;
	float:					right;
	margin-top:				2px;
	margin-right:			6px;
}
#demo-list li.file .file-info
{
	display:				block;
	margin-left:			44px;
	font-size:				0.9em;
	line-height:			20px;
	clear
}
#demo-list li.file .file-remove
{
	clear:					right;
	float:					right;
	line-height:			18px;
	margin-right:			6px;
}
	</style>
	<script type="text/javascript" src="js/mootools-1.2-core-nc.js"></script>
	<script type="text/javascript" src="js/Swiff.Uploader.js"></script>
	<script type="text/javascript" src="js/Fx.ProgressBar.js"></script>
	<script type="text/javascript" src="js/FancyUpload2.js"></script>
	<script type="text/javascript">
		/* <![CDATA[ */

window.addEvent('load', function() {

	// For testing, showing the user the current Flash version.
	document.getElement('h3 + p').appendText(' Detected Flash ' + Browser.Plugins.Flash.version + '!');

	var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
		url: $('form-demo').action,
		fieldName: 'photoupload',
		path: 'js/Swiff.Uploader.swf',
		limitSize: 2 * 1024 * 1024, // 2Mb
		onLoad: function() {
			$('demo-status').removeClass('hide');
			$('demo-fallback').destroy();
		},
		// The changed parts!
		debug: true, // enable logs, uses console.log
		target: 'demo-browse' // the element for the overlay (Flash 10 only)
	});

	/**
	 * Various interactions
	 */

	$('demo-browse').addEvent('click', function() {
		/**
		 * Doesn't work anymore with Flash 10: swiffy.browse();
		 * FancyUpload moves the Flash movie as overlay over the link.
		 * (see opeion "target" above)
		 */
		swiffy.browse();
		return false;
	});

	/**
	 * The *NEW* way to set the typeFilter, since Flash 10 does not call
	 * swiffy.browse(), we need to change the type manually before the browse-click.
	 */
	$('demo-select-images').addEvent('change', function() {
		var filter = null;
		if (this.checked) {
			filter = {'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'};
		}
		swiffy.options.typeFilter = filter;
	});

	$('demo-clear').addEvent('click', function() {
		swiffy.removeFile();
		return false;
	});

	$('demo-upload').addEvent('click', function() {
		swiffy.upload();
		return false;
	});

});
		/* ]]> */
	</script>

</head>
<body>
<div align="center">


<div class="container" id="container" >
	<div class="span-16 column colborder" id="content" style="display:none;">
		<div class="project">
			<div class="right quiet" title="Other versions">&nbsp;
			</div>
	<br class="clear" />

	<br />
	</div>

</div>	
<h3 style="display:none;">&nbsp;</h3>
<p style="display:none;"></p>
	<div id="demo">

<form action="script.php?folder=<?php echo $dossier; ?>" method="post" enctype="multipart/form-data" id="form-demo">
	<fieldset id="demo-fallback">
		<legend>File Upload</legend>
		<p>
			Selected your photo to upload.<br />
			<strong>This form is just an example fallback for the unobtrusive behaviour of FancyUpload.</strong>
		</p>
		<label for="demo-photoupload">
			Upload Photos:
			<input type="file" name="photoupload" id="demo-photoupload" />
		</label>
	</fieldset>

	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse">Parcourir...</a> |
			<input type="checkbox" id="demo-select-images" /> Images seules |
			<a href="#" id="demo-clear">Vider la liste</a> |
			<a href="#" id="demo-upload">Uploader</a>
		</p>
		<div>
			<strong class="overall-title">Progression globale</strong><br />
			<img src="img/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title">Progression du fichier</strong><br />
			<img src="img/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>

	<ul id="demo-list"></ul>

</form>
	</div>
	</div>

	</div>
</body>
</html>