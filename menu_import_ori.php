<?php 

$USERAUTH = new UserAuth();

$SESSION = new Session();

$SessionUser = $SESSION->get_session_user();

$menuPath = $USERAUTH->FrontEnd_show_menu($SessionUser);




?>
<div id="kiri">
     <div id="frame_kiri">
         <a href="<?php echo "$url_rewrite/";?>index.php"><div id="home"></div></a>
            <ul class="acc" id="acc">	
                <li>
                    <h3>Kartu Inventaris Barang</h3>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="<?php echo "$url_rewrite/import/";?>index.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang A
                                            </div>
                                        </div>
                                        </a>
                                        <a href="<?php echo "$url_rewrite/import/";?>kibb.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang B
                                            </div>
                                        </div>
                                        </a>
                                        <a href="<?php echo "$url_rewrite/import/";?>kibc.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang C
                                            </div>
                                        </div>
                                        </a>
                                        <a href="<?php echo "$url_rewrite/import/";?>kibd.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang D
                                            </div>
                                        </div>
                                        </a>
                                        <a href="<?php echo "$url_rewrite/import/";?>kibe.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang E
                                            </div>
                                        </div>
                                        </a>
                                        <a href="<?php echo "$url_rewrite/import/";?>kibf.php">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Kartu Inventaris Barang F
                                            </div>
                                        </div>
                                        </a>
					    <a href="<?php echo "$url_rewrite/import/template/template.tar.gz";?>">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Download Template Importing
                                            </div>
                                        </div>
                                        </a>
					<a href="<?php echo "$url_rewrite/import/template/perencanaan.tar.gz";?>">
                                        <div class="acc-section">
                                            <div class="acc-content">
                                                Download Template Perencanaan
                                            </div>
                                        </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
</div>


