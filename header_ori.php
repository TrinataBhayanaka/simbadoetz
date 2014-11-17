<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo "$title"; ?></title>
	<!-- include css file -->
	
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/simbada.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/perencanaan.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css">
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/example.css" TYPE="text/css" MEDIA="screen">
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/demo_page.css" TYPE="text/css" MEDIA="screen">
	<link rel="stylesheet" href="<?php echo "$url_rewrite/"; ?>css/demo_table.css" TYPE="text/css" MEDIA="screen">

	<!-- include javascript file -->	
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr1.js"></script>                     
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr2.js"></script>                                  
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/addtr3.js"></script>   
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/control.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.cookie.js"></script>
	<!--<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>-->
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.core.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
	<!--<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-1.7.2.js"></script>-->
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/multiple.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/multiple2.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/packed.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/select.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabber.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabber-minimized.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabs.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tes.js"></script>
           <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_checkbox.js"></script>
            <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_radio.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/show_penerimaan.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/ajax_radio_pengadaan.js"></script>



      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.js"></script>
      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.dataTables.js"></script>

      <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/paging-helper.js"></script>



	
	<link rel="shortcut icon" href="<?php echo "$url_rewrite/"; ?>favicon.ico" type="image/x-icon" />
</head>

<!--tambahan buat import pengadaan-->
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
	<script type="text/javascript" charset="utf-8">
/*		$(document).ready(function() {
			$('#example').dataTable( {
				"aaSorting": [[ 1, "asc" ]]
			} );
		} );*/
	</script>
