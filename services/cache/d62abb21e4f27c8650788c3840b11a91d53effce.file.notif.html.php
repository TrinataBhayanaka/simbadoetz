<?php /* Smarty version Smarty-3.1.15, created on 2015-10-15 14:31:46
         compiled from "app/view/notif.html" */ ?>
<?php /*%%SmartyHeaderCode:1823935050561f46dc4fc779-45466510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd62abb21e4f27c8650788c3840b11a91d53effce' => 
    array (
      0 => 'app/view/notif.html',
      1 => 1444894275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1823935050561f46dc4fc779-45466510',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_561f46dc53d7f0_50250551',
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_561f46dc53d7f0_50250551')) {function content_561f46dc53d7f0_50250551($_smarty_tpl) {?>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/css/smk-accordion.css" />

   
    <script type="text/javascript" src="$basedomain}assets/js/jquery-migrate-1.2.1.min.js"></script>

<section id="contact-info">
        <div class="container"> 
        <div class="row"> 
            <div class="col-sm-3">
                 <div class="box box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Notifikasi</h3>
                      <div class="box-tools">
                      
                    </div>
                     <div class="box-body no-padding">
                      <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">12</span></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                        <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                      </ul>
                    </div><!-- /.box-body -->
                 </div>
            </div>
            </div>
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail">
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button --> 
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody class="accordion_example2">
                        <tr class="unread">
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name">Ovan Sunarto Pulu
                             <div class="accordion_in">
                                <div class="acc_head">subjek Notifikasi</div>
                                <div class="acc_content">
                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.
                                </div>
                            </div>
                          </td>
                          <td class="mailbox-date">5 mins ago</td>
                        </tr>
                         <tr >
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name">Iswandi
                             <div class="accordion_in">
                                <div class="acc_head">subjek Notifikasi</div>
                                <div class="acc_content">
                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.
                                </div>
                            </div>
                          </td>
                          <td class="mailbox-date">15 mins ago</td>
                        </tr> 
                        <tr class="unread">
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name">Industri Rokok
                             <div class="accordion_in">
                                <div class="acc_head">subjek Notifikasi</div>
                                <div class="acc_content">
                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.
                                </div>
                            </div>
                          </td>
                          <td class="mailbox-date">25 mins ago</td>
                        </tr>

                        <tr >
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name">Balai Pusat
                             <div class="accordion_in">
                                <div class="acc_head">subjek Notifikasi</div>
                                <div class="acc_content">
                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.
                                </div>
                            </div>
                          </td>
                          <td class="mailbox-date">35 mins ago</td>
                        </tr>
                        <tr >
                          <td><input type="checkbox"></td>
                          <td class="mailbox-name">Balai balai
                             <div class="accordion_in">
                                <div class="acc_head">subjek Notifikasi</div>
                                <div class="acc_content">
                                    Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.
                                </div>
                            </div>
                          </td>
                          <td class="mailbox-date">45 mins ago</td>
                        </tr>


                       
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                      1-50/200
                      <div class="btn-group">
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                        <button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
        </div>
        
    </section>  <!--/gmap_area -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
assets/js/smk-accordion.js"></script>
    <script type="text/javascript">
    
        jQuery(document).ready(function($){

            $(".accordion_example2").smk_Accordion({
                closeAble: true, //boolean
            });


            
        });
    
    </script><?php }} ?>
