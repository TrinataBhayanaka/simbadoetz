<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 08:27:57
         compiled from "app/view/informasi/pengaduan.html" */ ?>
<?php /*%%SmartyHeaderCode:224840031546ecccd2aabb0-54288949%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7f32a1bf201d30b9204b51562ab1ef4b662f50c' => 
    array (
      0 => 'app/view/informasi/pengaduan.html',
      1 => 1417656471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '224840031546ecccd2aabb0-54288949',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546ecccd2b8199_08477065',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546ecccd2b8199_08477065')) {function content_546ecccd2b8199_08477065($_smarty_tpl) {?><section id="contact-info">
    <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>  
        <div class="center">                
            <h2><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</h2>
            <p class="lead">&nbsp;</p>

            <div class="row">
            	<div class="col-md-2"></div>
            <div class="col-md-8" style="text-align:left">
            	<p><?php echo $_smarty_tpl->tpl_vars['val']->value['content'];?>
</p>
            </div>
            <div class="col-md-2"></div>
            </div>
        </div>
        <?php } ?>
    <?php }?>
    </section>  <!--/gmap_area --><?php }} ?>
