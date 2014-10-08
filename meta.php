<html>
<head>
	<title> SIMBADA PEKALONGAN </title>
	<link rel="shortcut icon" href="<?php echo "$url_rewrite/"; ?>favicon.ico" type="image/x-icon" />
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/form_wizard.css"/>
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
		
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr.js"></script>             
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr2.js"></script>                                  
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr3.js"></script>   
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/control.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script>
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/multiple.js"></script>
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/packed.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/select.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabber.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabber-minimized.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabs.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_radio.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/show_penerimaan.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_radio_pengadaan.js"></script>

      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/paging-helper.js"></script>
	  
	   <script>
	function change_pemilik() 
	{
	    var objsrc = document.getElementById("p_pemilik").value;
	    var content = document.getElementById("posisiKolom")
	    content.value = objsrc;
	}
    </script>
    <script>
	function change_kabupaten() 
	{
	    var objsrc = document.getElementById("p_kabupaten").value;
	    var content = document.getElementById("posisiKolom2")
	    content.value = objsrc;
	}
    </script>
    <script>
	function change_tahun() 
	{
	    var objsrc = document.getElementById("p_tahun").value;
	    var content = document.getElementById("posisiKolom4")
	    content.value = objsrc;
	}
    </script> 
</head>
<body>
