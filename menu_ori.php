<?php 

$USERAUTH = new UserAuth();

$SESSION = new Session();

$SessionUser = $SESSION->get_session_user();

$menuPath = $USERAUTH->FrontEnd_show_menu($SessionUser);


?>
<div id="kiri">
     <div id="frame_kiri">
		<a href="<?php echo "$url_rewrite";?>"><div id="home"></div></a>
            <ul class="acc" id="acc">
<?php 
$i = 0;

if(!empty($menuPath))
{

// pr($menuPath);
foreach ($menuPath[0] as $key => $menuParent)
{
	
	
	?>
	
				<li>
                    <h3><?php echo $key; ?></h3>
	<?php 
	$j = $i;
	foreach ($menuParent as $menuChild)
	{
		//echo $v2;
		?>
						<div class="acc-section">
                              <div class="acc-content">
                                   <ul class="acc" id="nested2">
                                        <li>
                                        	<a href="<?php echo $url_rewrite."/module/".$menuPath[1][$j]; ?>">
	                                             <div class="acc-section">
													<div class="acc-content"><?php echo $menuChild?></div>
	                                             </div>
                                             </a>
                                        </li>
                                    </ul>
                              </div>
						</div>
		<?php 
	$j++;
	}
				?>
				</li>
				<?php 
	$i = $j;
	
}

}
    

     

?>
		</ul>
	</div>
</div>

<?php 

?>
