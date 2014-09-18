<?php
include "../../config/config.php";
?>


<html>
    <?php
    include "$path/header.php";

$menu_id = 1;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
    ?>
  
	<body>
	<div id="content">
	<?php
	
        include "$path/title.php";
        include "$path/menu.php";
        ?>
        
            <div id="tengah1">
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Pengadaan
                        </div>
                        <div id="bottomright">
							Cara Inputan Pengadaan :
							<form name="lda_filter" action="<?php echo "$url_rewrite/module/perolehan/"; ?>pengadaan.php?pid=1" method="post">
								<table border="0">
									<script type="text/javascript" src="../../JS/tabel.js"></script>
										
									
									<tr>
										
										<td>
											<a href="<?php echo "$url_rewrite";?>/module/perolehan/perolehan_pengadaan.php"; ><input type ="button" value="Pengadaan Manual" style="width:200px; height:100px;" FONT SIZE='18' >&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											
										<td><a href="<?php echo "$url_rewrite";?>/import"; ><input type ="button" value="Importing" style="width:200px; height:100px;" FONT SIZE='18' >&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										
										<td><a href="<?php echo "$url_rewrite";?>/module/perolehan/rtb_pengadaan.php"; ><input type="button" value="Daftar RTP" style="width:200px; height:100px;"FONT SIZE='18' ></td>
										</a>
									</tr>
								</table>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
        include "$path/footer.php";
        ?>
     </body>
</html>	
