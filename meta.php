<html>
<head>
	<title> SIMBADA PEKALONGAN </title>
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/style_simbada.css">    
        <link href="<?php echo "$url_rewrite/"; ?>css/bootstrap.min_simbada.css" rel="stylesheet">
        <link href="<?php echo "$url_rewrite/"; ?>css/bootstrap-responsive_simbada.css" rel="stylesheet">
		<style type="text/css" title="currentStyle">
			@import "<?php echo "$url_rewrite/"; ?>css/demo_table_simbada.css";
		</style>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery_simbada.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.dataTables_simbada.js"></script>
		
		<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css">
		<script src="<?php echo "$url_rewrite/"; ?>js/jquery-ui.js"></script>
		 <script>
			$(function() {
			$( "#datepicker" ).datepicker();
			});
		</script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"
				} );
				$('#example2').dataTable( {
					"sPaginationType": "full_numbers"
				} );
			} );
		</script>
</head>
<body>
