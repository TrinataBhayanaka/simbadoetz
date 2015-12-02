<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 07:18:38
         compiled from "app/view/news.html" */ ?>
<?php /*%%SmartyHeaderCode:89384334554477d248b2ab4-97616504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f47c2ec5c611f3a65aa71ae70833c8364ee3e63' => 
    array (
      0 => 'app/view/news.html',
      1 => 1417652316,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89384334554477d248b2ab4-97616504',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54477d248cf0b5_75331676',
  'variables' => 
  array (
    'data' => 0,
    'val' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54477d248cf0b5_75331676')) {function content_54477d248cf0b5_75331676($_smarty_tpl) {?>
<section id="blog" class="container">
        
        <div class="center">
            <h2>News Update</h2>
            
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
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 text-center">
                                <div class="entry-meta">
                                    <span id="publish_date"><?php echo $_smarty_tpl->tpl_vars['val']->value['changeDate'];?>
</span>
                                    <span><i class="fa fa-user"></i> <a href="#">NAPZA</a></span>
                                    
                                </div>
                            </div>
                                
                            <div class="col-xs-12 col-sm-10 blog-content" align="justify">
                                <?php if ($_smarty_tpl->tpl_vars['val']->value['image']) {?>
                                <a href="#">
                                    <img class="img-responsive img-blog" src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['val']->value['image'];?>
" width="100%"  alt="" />
                                </a>
                                <?php }?>
                                <h2><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
news/detailnews/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</a></h2>
                                <h3><?php echo $_smarty_tpl->tpl_vars['val']->value['content'];?>
</h3>
                                <a class="btn btn-primary readmore" href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
news/detailnews/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">Detail <i class="fa fa-angle-right"></i></a>
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
        </div>
    </section><!--/#blog-->

<?php }} ?>
