<?php /* Smarty version Smarty-3.1.15, created on 2014-12-13 08:33:59
         compiled from "app/view/publikasi/peraturan.html" */ ?>
<?php /*%%SmartyHeaderCode:650861489546ec8790b6a62-07358388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f873e6950c912826c21124b538b983265f9b73af' => 
    array (
      0 => 'app/view/publikasi/peraturan.html',
      1 => 1418378917,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '650861489546ec8790b6a62-07358388',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546ec87924c1f2_84332181',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546ec87924c1f2_84332181')) {function content_546ec87924c1f2_84332181($_smarty_tpl) {?><section id="contact-info">
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
        <div class="row">
                <div class="col-md-2"></div>
            
            <div class="col-md-8">
                
                <p><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/PerKBPOM.pdf" target="_blank">PMK No. 28 ttg Peringatan dan Informasi Pada Kemasan Produk Tembakau<a/></p>
                <p><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/PP_109_tahun_2012.pdf" target="_blank">PerKBPOM No 41 Tahun 2013 Tentang Pengawasan Produk Tembakau yang Beredar<a/></p>
                <p><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/PMK_No_28.pdf" target="_blank">PP 109 tahun 2012 tentang PENGAMANAN BAHAN YANG MENGANDUNG ZAT ADIKTIF BERUPA PRODUK TEMBAKAU BAGI KESEHATAN<a/></p>
            </div>
            <div class="col-md-2"></div>
            
            </div>
    </section>  <!--/gmap_area --><?php }} ?>
