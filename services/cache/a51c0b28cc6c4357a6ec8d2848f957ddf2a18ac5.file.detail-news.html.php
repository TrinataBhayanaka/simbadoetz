<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 07:18:15
         compiled from "app/view/detail-news.html" */ ?>
<?php /*%%SmartyHeaderCode:13042633265468184f8d0205-86122295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a51c0b28cc6c4357a6ec8d2848f957ddf2a18ac5' => 
    array (
      0 => 'app/view/detail-news.html',
      1 => 1417652293,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13042633265468184f8d0205-86122295',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5468184f90b934_90694463',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5468184f90b934_90694463')) {function content_5468184f90b934_90694463($_smarty_tpl) {?><section id="blog" class="container">
        <div class="center">
            <h2>Detail News</h2>
            <p class="lead">&nbsp;</p>
        </div>

        <div class="blog">
            <div class="row">

                
                <div class="col-md-8">

                    <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>

                    <div class="blog-item">
                        <?php if ($_smarty_tpl->tpl_vars['val']->value['image']) {?>
                        <a href="#">
                                    <img class="img-responsive img-blog" src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['val']->value['image'];?>
" width="100%"  alt="" />
                                </a>
                        <?php }?>
                            <div class="row">  
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date"><?php echo $_smarty_tpl->tpl_vars['val']->value['changeDate'];?>
</span>
                                        <span><i class="fa fa-user"></i> <a href="#"> NAPZA</a></span>
                                       
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    <h2><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</h2>
                                    <p><?php echo $_smarty_tpl->tpl_vars['val']->value['content'];?>
</p>
                                    
                                </div>
                            </div>
                        </div><!--/.blog-item-->
                        <?php } ?>
                    <?php }?>
                    </div><!--/.col-md-8-->
                    

                      <aside class="col-md-4">
                    <div class="widget search">
                        <form role="form">
                                <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
                        </form>
                    </div><!--/.search-->
                    
                
                    
                </aside>  
                

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->
<?php }} ?>
