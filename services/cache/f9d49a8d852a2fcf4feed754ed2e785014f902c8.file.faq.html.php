<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 08:34:08
         compiled from "app/view/informasi/faq.html" */ ?>
<?php /*%%SmartyHeaderCode:1185730158546eccd11b8bd8-19606272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9d49a8d852a2fcf4feed754ed2e785014f902c8' => 
    array (
      0 => 'app/view/informasi/faq.html',
      1 => 1417656471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1185730158546eccd11b8bd8-19606272',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546eccd11c17e4_17265306',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546eccd11c17e4_17265306')) {function content_546eccd11c17e4_17265306($_smarty_tpl) {?><section id="contact-info">
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
