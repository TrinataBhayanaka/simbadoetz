<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 06:07:34
         compiled from "/home/erjoned/Data/xampp/htdocs/simbadoetz/services/app/view/master_template/jsplugin.html" */ ?>
<?php /*%%SmartyHeaderCode:1427592353565e8aa6224101-32307190%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9288da40d0cd476af477a93607543f0774e9543f' => 
    array (
      0 => '/home/erjoned/Data/xampp/htdocs/simbadoetz/services/app/view/master_template/jsplugin.html',
      1 => 1449035143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1427592353565e8aa6224101-32307190',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565e8aa623ba53_60363270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565e8aa623ba53_60363270')) {function content_565e8aa623ba53_60363270($_smarty_tpl) {?>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/angular/angular.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/dist/js/pages/dashboard2.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/dist/js/demo.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugin/datepicker/bootstrap-datepicker.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script type="text/javascript">
  $('select').select2();
</script>
<script type="text/javascript">

var base_url='<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
';

 $("#click.page").click(function(e){

  pageurl = $(this).attr('href');
            // alert(pageurl);
            $newpage =base_url+"home/index/?page="+pageurl;

            if(pageurl!=window.location){
                window.history.pushState({path:$newpage},'',$newpage);
            }

            $.post(base_url+"home/ajaxPage",{page:pageurl}, function(data){
                            // console.log(data);
                            if (data.status==true) {
                               // console.log(data.data);

                                 
                                    $('#pageAjax').html(data.data); 
                                    
                                    $('.ajax-spinner-bars').css("display","none");
                            }else{
                                 $('.ajax-spinner-bars').css("display","none"); 
                            }
                        }, "JSON")

            return false;
            
        });




</script><?php }} ?>
