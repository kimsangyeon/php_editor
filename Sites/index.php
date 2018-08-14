<html>
	<head>
		<link href = 'src/static/css/synapeditor.css' rel='stylesheet' type='text/css'>
    	<script src='src/static/js/synapeditor.js'></script>
	</head>
	<body>
		<div id="synapEditor" class="container"></div>
		<?php
			echo ("<script language=javascript> window.editor = new SynapEditor('synapEditor', {
				importAPI: `/~kimsangyeon/upload.php`,
				imageUploadAPI: `/~kimsangyeon/upload.php`,
    			videoUploadAPI: `/~kimsangyeon/upload.php`,
    			fileUploadAPI: `/~kimsangyeon/upload.php`,
			});</script>");
		?>
   </body>
</html>