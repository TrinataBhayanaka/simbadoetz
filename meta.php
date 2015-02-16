<?php
$isLogin = false;
$u_sess = $_SESSION['ses_uoperatorid'];
if ($u_sess) $isLogin = true;
?>

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
         <link href="<?php echo "$url_rewrite/"; ?>js/nprogress/nprogress.css" rel="stylesheet"/>
		<style type="text/css" title="currentStyle">
			@import '<?php echo "$url_rewrite/"; ?>css/demo_table_simbada.css';
		</style>

		<script type="text/javascript" charset="utf-8">

				var urlRewrite = "<?php echo $url_rewrite?>";
		</script>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery_simbada.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite/"; ?>js/jquery.dataTables_simbada.js"></script>
   
		
		<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css">
		<script src="<?php echo "$url_rewrite/"; ?>js/jquery-ui.js"></script>
		 <script>
			$(function() {
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
			$( "#datepicker-other" ).datepicker({ dateFormat: 'yy-mm-dd' });
			initTableCheckable ();
			});
		</script>
		<script type="text/javascript" charset="utf-8">
			function updDataCheckbox(item){
				var temp = new Array();
				var data = "";
				var tempc = new Array();
				var datac = "";
				arrunchecked = $('.icheck-input').map(function() {
						    if(!this.checked){
						    	if(this.value != 'on'){
						    		temp.push(this.value);
				    		 		data = temp.join();
						    	}
						    } else {
						    	if(this.value != 'on'){
						    		tempc.push(this.value);
				    		 		datac = tempc.join();
						    	}
						    }
						}).get();
				// console.log(datac);
				 $.post('<?=$url_rewrite?>/function/api/applist.php', {data:datac, undata:data, UserNm:'<?=$_SESSION['ses_uoperatorid']?>',act:item,sess:'<?=$_SESSION['ses_utoken']?>'}, function(data){
				
				 })
			}
			

			$(document).ready(function() {
				$('#example').dataTable( {
					"sPaginationType": "full_numbers"				
				} );
				$('#example2').dataTable( {
					"sPaginationType": "full_numbers"
				} );

				$('#penghapusan10').dataTable( {
					"sPaginationType": "full_numbers",
    				"aoColumns": [

						null,
						{ "asSorting": false},
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					
					
				} );
				$('#penghapusan11').dataTable( {
					"sPaginationType": "full_numbers",
    				"aoColumns": [

						null,
						{ "asSorting": false},
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					
					
				} );
				$('#penghapusan8').dataTable( {
					"sPaginationType": "full_numbers",
    				"aoColumns": [

						null,
						{ "asSorting": false},
						null,
						null,
						null,
						null,
						null,
						null
					],
					
					
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
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/maskedinput/jquery.maskedinput.min.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/tableCheckable/jquery.tableCheckable.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/autoNumeric/autoNumeric.js"></script>
	  <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/nprogress/nprogress.js"></script>
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

	
	
	/* check user idle time */
	var lifetime = "1200";
	var isLogin = "<?php echo $isLogin;?>";	
	var idleMax = parseInt(lifetime,10);
	var idleTime = 0;
	$(document).ready(function () {
		if(isLogin) {
			
			var my_timer = setTimeout(trackuser, 1000);
			$(this).mousemove(function (e) {idleTime = 0;});
			$(this).keypress(function (e) {idleTime = 0;});
		}
	})

	function trackuser() {
		idleTime = idleTime + 1;
		if (idleTime > idleMax) { 
			location.href = basedomain+"/logout.php?utoken=1";			
		}else {
			$(this).mousemove(function (e) {idleTime = 0;});
			$(this).keypress(function (e) {idleTime = 0;});
			var my_timer = setTimeout(trackuser, 1000);
		}
		
	}

	
	
    </script> 
     <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>js/paging-helper.js"></script>
</head>
<body>
