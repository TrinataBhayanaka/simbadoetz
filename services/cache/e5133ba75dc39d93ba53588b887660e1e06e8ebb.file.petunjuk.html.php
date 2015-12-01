<?php /* Smarty version Smarty-3.1.15, created on 2015-09-10 14:34:20
         compiled from "app/view/informasi/petunjuk.html" */ ?>
<?php /*%%SmartyHeaderCode:181420903155f1327c4a75c2-29409336%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5133ba75dc39d93ba53588b887660e1e06e8ebb' => 
    array (
      0 => 'app/view/informasi/petunjuk.html',
      1 => 1418371022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181420903155f1327c4a75c2-29409336',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_55f1327c771e58_63741262',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f1327c771e58_63741262')) {function content_55f1327c771e58_63741262($_smarty_tpl) {?><section id="contact-info">
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

            <div class="row">
                <div class="col-md-2"></div>
            
            <div class="col-md-8">
                <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/petunjuk_penggunaan.docx" target="_blank">Download Buku Manual</a>
            </div>
            <div class="col-md-2"></div>
                
            </div>

        </div>
        <?php } ?>
    <?php }?>
    </section>  <!--/gmap_area --><?php }} ?>
