<?php /* Smarty version Smarty-3.1.15, created on 2015-09-10 14:36:25
         compiled from "app/view/visimisi.html" */ ?>
<?php /*%%SmartyHeaderCode:69033893055f132f9a73540-28637954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76108ce8f4dfc97e50081f4fa07f0d69283bc753' => 
    array (
      0 => 'app/view/visimisi.html',
      1 => 1418368584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69033893055f132f9a73540-28637954',
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
  'unifunc' => 'content_55f132f9accb96_97287506',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f132f9accb96_97287506')) {function content_55f132f9accb96_97287506($_smarty_tpl) {?><section id="contact-info">
        <div class="">  
        <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>              
            <div class="center"><h2><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</h2></div>
            
            <div class="row">
            	<div class="col-md-2"></div>
           
            <div class="col-md-8">
                 <?php if ($_smarty_tpl->tpl_vars['val']->value['image']) {?>
            	<img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['val']->value['image'];?>
" width="100%"><?php }?>
            </div>
            
            <div class="col-md-2"></div>
                
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
            
            <div class="col-md-8">
                
                <p><?php echo $_smarty_tpl->tpl_vars['val']->value['content'];?>
</p>
            </div>
            <div class="col-md-2"></div>
            
            </div>
            <?php } ?>
        <?php }?>
        </div>
        
    </section>  <!--/gmap_area --><?php }} ?>
