<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include "../config/config.php";
?>
<html>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?=$title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="../css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="../css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="../css/example.css" TYPE="text/css" MEDIA="screen">
    </head>
    <body>
        <div>
            <div id="frame_header">
                <div id="header"></div>
            </div>
            <div id="list_header"></div>
            <div id="kiri">
            <div id="frame_kiri">
	<a href="<?php echo "$url_rewrite"?>"><div id="home"></div></a>
	<ul class="acc" id="acc">
		<li>
			<h3>About</h3>
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
						<a href="index.php?page=1">
							<div class="acc-section">
								<div class="acc-content">Team Work</div>
							</div>
						</a>
						</li>
					</ul>
				</div>
			</div>
			<!--
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
						<a href="index.php?page=2">
							<div class="acc-section">
								<div class="acc-content">Team Work</div>
							</div>
						</a>
						</li>
					</ul>
				</div>
			</div>-->
		</li>
		<li>
			<a href="index.php?page=copyright"><h3>Copyright</h3></a>
			<!--
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="">
								<div class="acc-section">
									<div class="acc-content">new sub</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>-->
			
		</li>
		<li>
			<h3>Simbada Manual</h3>
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="index.php?page=4">
								<div class="acc-section">
									<div class="acc-content">Simbada doc</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</li>

		<li>
			<h3>Getting Started</h3>
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="?page=sys_req">
								<div class="acc-section">
									<div class="acc-content">System Required</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</li>
		<li>
			<h3>Installation</h3>
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="installasi/?page=itoc">
								<div class="acc-section">
									<div class="acc-content">Install Configuration</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</li>
		<li>
			<a href="../services" style="color: white"><h3>Web Services</h3></a>
			
		</li>
		<li>
			<a href="index.php?page=features"><h3>Features</h3></a>
			<!--
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="">
								<div class="acc-section">
									<div class="acc-content">new sub</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>-->
		</li>
		
		<li>
			<a href="?page=faq"><h3>FAQ</h3></a>
			<!--
			<div class="acc-section">
				<div class="acc-content">
					<ul class="acc" id="nested2">
						<li>
							<a href="">
								<div class="acc-section">
									<div class="acc-content">new sub</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>-->
		</li>
	</ul>
	</div>

        </div>
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                        
                        <?php
                        $page = $_GET['page'];
                        if ($page == '1') $data = 'Team Work';
                        if ($page == '2') $data = 'Team Work';
                        if ($page == '4') $data = 'Simbada Document';
                        echo "<label style='font-size:16px'>Help &raquo;</label><label style='font-size:12px'> $data</label>";
                        echo "<br>";
                        
                        switch ($page){
                            case '1':
                                {
                                    include 'team_work.php'; 
                                }
                                break;
                                /*
                            case '2':
                                {
                                    include 'team_work.php'; 
                                }
                                break;*/
                            case '6':
                                {
                                    echo "<h3>Gagal loading content</h3>";
                                }
                                break;
                            case 'copyright':
                                {
                                    include 'copyright.php'; 
                                }
                                break;
                            case 'sys_req':
                                {
                                    include 'sys_req.php'; 
                                }
                                break;
                            case 'features':
                                {
                                    include 'features.php'; 
                                }
                                break;
                            case 'faq':
                                {
                                    include 'faq.php'; 
                                }
                                break;
                            case 'help':
                                {
                                    include 'simbada_help_home.php'; 
                                }
                                break;
                            
                            default:
                                {
									include 'simbada_help_home.php';
								  
                                }
                        }
                        
                        ?>
                        
                    </fieldset>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>
</html>
