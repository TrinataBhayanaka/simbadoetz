<?php /* Smarty version Smarty-3.1.15, created on 2015-10-15 13:25:22
         compiled from "app/view/header.html" */ ?>
<?php /*%%SmartyHeaderCode:885224408546800c5a3dfc2-42790796%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e92366fadccd12ed22bfb5c490087f1c092d930b' => 
    array (
      0 => 'app/view/header.html',
      1 => 1444890305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '885224408546800c5a3dfc2-42790796',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546800c5ae2685_34361611',
  'variables' => 
  array (
    'basedomain' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546800c5ae2685_34361611')) {function content_546800c5ae2685_34361611($_smarty_tpl) {?>
<body class="homepage">

    <header id="header">
        <div class="top-bar">
             
            <div class="container">
                <div class="row">
                   
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>   021-4245523 / 4244691 (ext. 1075)</p></div>
                    </div>
					
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            
                       </div>
                    </div>
					
                </div>
            </div><!--/.container-->
            
            <div class="row" style=" background-image: url(<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/images/head_1.png); background-repeat: no-repeat; height:60px; margin-left:80px">&nbsp;
			
			</div>
			
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
">
                    	
                    	E-Tobacco Control
                    </a>
                </div>
               
				<div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        
                        <!--<li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
about_us">About Us</a></li>-->
						 
                        <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
                        
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">Produsen / Importir</a></li> 
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik">Lokasi Pabrik</a></li> 
                        

                        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Pelaporan <i class="fa fa-angle-down"></i></a>
							 <ul class="dropdown-menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan">Kemasan</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin">Nikotin dan TAR</a></li>
                               
                            </ul>
						
						</li>
						<li class="dropdown"><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account"  class="dropdown-toggle" data-toggle="dropdown"> Hi,  <?php echo $_smarty_tpl->tpl_vars['user']->value['default']['name'];?>
</a>
							 <ul class="dropdown-menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/notifikasi">Notifikasi<span class="badge">42</span></a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/profile">Profil</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
logout.php">Logout</a></li>
                               
                            </ul>
						
						</li>

						 
                        <?php } else { ?>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home">Beranda</a></li>
                        
                        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Profil <i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
profile/visimisi">Visi Misi</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
profile">Struktur Organisasi</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
profile/tupoksi">Tugas Pokok dan Fungsi</a></li>
                            </ul>
                        
                        </li>
                        <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
news">Berita</a></li>
                        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Publikasi <i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
publikasi/peraturan">Peraturan dan Kebijakan</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
publikasi/penelitian">Hasil Penelitian</a></li>
                               
                            </ul>
                        
                        </li>
                        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Informasi <i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
informasi/pengaduan">Saran dan Pengaduan</a></li>
                               
                               <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
informasi/faq">FAQ</a></li>
                            </ul>
                        
                        </li>
                        <li class="dropdown"><a href="#"  class="dropdown-toggle" data-toggle="dropdown">Sistem Pelaporan <i class="fa fa-angle-down"></i></a>
                             <ul class="dropdown-menu">
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
informasi/prosedur">Alur Prosedur</a></li>
                                <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
informasi/petunjuk">Petunjuk Penggunaan</a></li>
                               <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
login">Login</a></li>
                            </ul>
                        
                        </li>
                        
                        <?php }?>                   
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header--><?php }} ?>
