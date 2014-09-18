<?php 

$USERAUTH = new UserAuth();

$SESSION = new Session();

$SessionUser = $SESSION->get_session_user();

$menuPath = $USERAUTH->FrontEnd_show_menu($SessionUser);


?>
<aside>
		<nav>
			<ul>
				<li>
					<ul>
						<a href="<?php echo "$url_rewrite";?>"><li class="home"><img src="<?php echo "$url_rewrite";?>/img/home.png" /></li></a>
					</ul>
				</li>
				<?php 
					$i = 0;

					if(!empty($menuPath))
					{

					// pr($menuPath);
					foreach ($menuPath[0] as $key => $menuParent)
					{
						
				?>
				<li><h3><?php echo $key; ?></h3>
					<ul>
				<?php 
					$j = $i;
					foreach ($menuParent as $menuChild)
					{
						//echo $v2;
				?>
						<a href="<?php echo $url_rewrite."/module/".$menuPath[1][$j]; ?>"><li><?php echo $menuChild?></li></a>
				<?php 
					$j++;
					}
				?>
				</ul>
				</li>
				<?php 
					$i = $j;
					
				}

				}
				?>
				
			</ul>
		</nav>
	</aside>