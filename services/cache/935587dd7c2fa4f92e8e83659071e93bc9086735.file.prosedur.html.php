<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 08:34:38
         compiled from "app/view/informasi/prosedur.html" */ ?>
<?php /*%%SmartyHeaderCode:1204578944546ecccb6528d9-79496082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '935587dd7c2fa4f92e8e83659071e93bc9086735' => 
    array (
      0 => 'app/view/informasi/prosedur.html',
      1 => 1417656471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1204578944546ecccb6528d9-79496082',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546ecccb659ed2_65113774',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546ecccb659ed2_65113774')) {function content_546ecccb659ed2_65113774($_smarty_tpl) {?><section id="contact-info">
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
