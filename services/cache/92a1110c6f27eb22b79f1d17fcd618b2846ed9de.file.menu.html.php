<?php /* Smarty version Smarty-3.1.15, created on 2014-11-13 20:50:14
         compiled from "app/view/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:343351972544772d9d8b427-76840300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92a1110c6f27eb22b79f1d17fcd618b2846ed9de' => 
    array (
      0 => 'app/view/menu.html',
      1 => 1415886610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '343351972544772d9d8b427-76840300',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_544772d9d8f6d0_83302588',
  'variables' => 
  array (
    'basedomain' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544772d9d8f6d0_83302588')) {function content_544772d9d8f6d0_83302588($_smarty_tpl) {?>
<div id="head"> 
    <center>
        <div id="linebg"></div>
        <div id="headbg"></div>
        <div id="logo"></div>
    </center>   
        <div id="menu">
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
">Home</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
news">News</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
profile">Profile</a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
contact">Contact Us</a>
        </div>
        
        <div id="" align="right" style="margin-top:-96px;margin-right:114px;">
                <input type="text" id="" placeholder ="Find news" /> &nbsp; <input class="form-btn-register btn" type="button" value="Search" name="search" id="seacrh" />            
        </div>
        

        <div id="login" align="right" style="margin-top:46px;margin-right:114px;">
            <?php if ($_smarty_tpl->tpl_vars['user']->value) {?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account"><?php echo $_smarty_tpl->tpl_vars['user']->value['default']['name'];?>
</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">Industri</a> | 
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik">Pabrik</a> |
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan">Kemasan</a> |
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin">Nikotin & Tar</a> |
            <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
logout.php"> Logout</a>

            <?php } else { ?>
            <a href="#" onclick="login()"> Login</a>
            <?php }?>
        </div>
    </div><?php }} ?>
