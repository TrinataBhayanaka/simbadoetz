<html>
<head>
	<title> SIMBADA PEKALONGAN </title>
	<link rel="shortcut icon" href="<?php echo "$url_rewrite/"; ?>favicon.png" type="image/x-icon" />
	<!--<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/form_wizard.css"/>
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/style_simbada.css">    
        <link href="<?php echo "$url_rewrite/"; ?>css/bootstrap.min_simbada.css" rel="stylesheet">
        <link href="<?php echo "$url_rewrite/"; ?>css/bootstrap-responsive_simbada.css" rel="stylesheet">
         <link href="<?php echo "$url_rewrite/"; ?>js/select2/select2.css" rel="stylesheet"/>
		<style type="text/css" title="currentStyle">
			@import '<?php echo "$url_rewrite/"; ?>css/demo_table_simbada.css';
		</style>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery_simbada.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.dataTables_simbada.js"></script>
		
		<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css">
		<script src="<?php echo "$url_rewrite/"; ?>js/jquery-ui.js"></script>
		 <script>
			$(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
			initTableCheckable ();
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
		
		<!--<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/addtr.js"></script>             
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/addtr2.js"></script>                                  
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/addtr3.js"></script>   
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/control.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.cookie.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.ui.datepicker-id.js"></script>
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery-ui.min.js"></script>-->
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/multiple.js"></script>
	
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/packed.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/select.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tabber.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tabber-minimized.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tabs.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/ajax_checkbox.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/ajax_radio.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/show_penerimaan.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/ajax_radio_pengadaan.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/select2/select2.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/paging-helper.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/maskedinput/jquery.maskedinput.min.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tableCheckable/jquery.tableCheckable.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/autoNumeric/autoNumeric.js"></script>
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

	function initTableCheckable () {
		if ($.fn.tableCheckable) {
			$('.table-checkable')
		        .tableCheckable ()
			        .on ('masterChecked', function (event, master, slaves) { 
			            if ($.fn.iCheck) { $(slaves).iCheck ('update'); }
			        })
			        .on ('slaveChecked', function (event, master, slave) {
			            if ($.fn.iCheck) { $(master).iCheck ('update'); }
			        });
		}
	}

	var basedomain = "<?php echo $url_rewrite?>";
	
    </script> 
</head>
<body>
