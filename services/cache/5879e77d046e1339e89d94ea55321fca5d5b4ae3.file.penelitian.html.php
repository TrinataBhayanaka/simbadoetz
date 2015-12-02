<?php /* Smarty version Smarty-3.1.15, created on 2014-12-12 11:26:33
         compiled from "app/view/publikasi/penelitian.html" */ ?>
<?php /*%%SmartyHeaderCode:2091712222546ec87d0b5c68-92473593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5879e77d046e1339e89d94ea55321fca5d5b4ae3' => 
    array (
      0 => 'app/view/publikasi/penelitian.html',
      1 => 1418358389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2091712222546ec87d0b5c68-92473593',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546ec87d0c7309_64623674',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546ec87d0c7309_64623674')) {function content_546ec87d0c7309_64623674($_smarty_tpl) {?><section id="contact-info">
        <div class="">  
        <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>              
            <div class="center"><h2><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</h2></div>
            <p class="lead">&nbsp;</p>

            <div class="row">
            	<div class="col-md-2"></div>
            
            <div class="col-md-8">
            	<img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['val']->value['image'];?>
" width="100%">
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
