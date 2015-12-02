<?php /* Smarty version Smarty-3.1.15, created on 2015-12-02 11:04:02
         compiled from "app/view/master_template/jsplugin.html" */ ?>
<?php /*%%SmartyHeaderCode:13748279565659a413a6e1a6-15105368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b69a918042097f57f70b80071e420610f7abb9f' => 
    array (
      0 => 'app/view/master_template/jsplugin.html',
      1 => 1449054194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13748279565659a413a6e1a6-15105368',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5659a413a763b0_54196069',
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5659a413a763b0_54196069')) {function content_5659a413a763b0_54196069($_smarty_tpl) {?>
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
assets/dist/js/app.js"></script>
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
assets/datepicker/bootstrap-datepicker.js"></script>

<script src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $('select').select2();
</script>
    <script type="text/javascript">
      $("button#tombol").click(function(e){

            $('span#linkUrl').css("display","block");

        }
    );
    $("input#datepicker.tahunAwal,input#datepicker.tahunAkhir").change(function(e){

            $('span#linkUrl').css("display","none");

        }
    );


    $( "input#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });

      </script>
<script type="text/javascript">

var base_url='<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
';

 // $("#click.page").click(function(e){

 //  pageurl = $(this).attr('href');
 //            // alert(pageurl);
 //            $newpage =base_url+"home/index/?page="+pageurl;

 //            if(pageurl!=window.location){
 //                window.history.pushState({path:$newpage},'',$newpage);
 //            }

 //            $.post(base_url+"home/ajaxPage",{page:pageurl}, function(data){
 //                            // console.log(data);
 //                            if (data.status==true) {
 //                               // console.log(data.data);

                                 
 //                                    $('#pageAjax').html(data.data); 
                                    
 //                                    $('.ajax-spinner-bars').css("display","none");
 //                            }else{
 //                                 $('.ajax-spinner-bars').css("display","none"); 
 //                            }
 //                        }, "JSON")

 //            return false;
            
 //        });




</script><?php }} ?>
