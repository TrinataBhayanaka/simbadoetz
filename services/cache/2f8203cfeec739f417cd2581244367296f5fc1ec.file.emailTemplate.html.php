<?php /* Smarty version Smarty-3.1.15, created on 2014-11-19 16:42:01
         compiled from "app/view/emailTemplate.html" */ ?>
<?php /*%%SmartyHeaderCode:288357214546c5ce799e421-67226557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f8203cfeec739f417cd2581244367296f5fc1ec' => 
    array (
      0 => 'app/view/emailTemplate.html',
      1 => 1416388455,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '288357214546c5ce799e421-67226557',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546c5ce7b6dec5_50913276',
  'variables' => 
  array (
    'email' => 0,
    'basedomain' => 0,
    'encode' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546c5ce7b6dec5_50913276')) {function content_546c5ce7b6dec5_50913276($_smarty_tpl) {?>
<html>
    <body>
        <table id="background-table" style="" cellpadding="0" cellspacing="0" align="center" border="0" width="100%">
           <tbody>
                <tr>
                      <td align="center" bgcolor="#ffffff">
                           <table class="w640" style="margin:0 10px;" cellpadding="0" cellspacing="0" border="0" width="640">
                           <tbody>
                                <tr><td class="w640" height="10" width="640"></td></tr>
                                
                                <tr>
                                    <td id="header" class="w640" align="center" bgcolor="#ccd" width="640">
                        
                                        <table class="w640" cellpadding="0" cellspacing="0" border="0" width="640">
                                            <tbody>
                                                <tr><td class="w30" width="30"></td><td class="w580" height="10" width="580"></td><td class="w30" width="30"></td>
                                                </tr>
                                                <tr>
                                                    <td class="w30" width="30"></td>
                                                    <td class="w580" width="580">
                                                        <div id="headline" align="center">
                                                            <p>
                                                                <strong><h2>E-Tobacco Control</h2></strong>
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="w30" width="30"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                                                            
                                    </td>
                                </tr>
                                                                                        
                                <tr><td class="w640" bgcolor="#ffffff" height="30" width="640"></td></tr>
                                <tr id="simple-content-row">
                                    <td class="w640" bgcolor="#ffffff" width="640">
                                    <table class="w640" cellpadding="0" cellspacing="0" align="left" border="0" width="640">
                                        <tbody>
                                            <tr>
                                                <td class="w30" width="30"></td>
                                                <td class="w580" width="580">
                                                    <repeater>
                                                        <layout label="Text only">
                                                        <table class="w580" cellpadding="0" cellspacing="0" border="0" width="580">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="w580" width="580">
                                                                        <p class="article-title" align="left"><singleline label="Title">Selamat datang,</singleline>
</p>
<p>Kami sudah menerima permintaan pembuatan akun anda di <a href="http://flora-kalbar.info">e-tobacco-control</a>. Berikut ini adalah informasi akun anda</p>

<p>Email : <u><?php echo $_smarty_tpl->tpl_vars['email']->value;?>
</u></p>
    <div class="article-content" align="left">
    <multiline label="Description"><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
register/validate/?ref=<?php echo $_smarty_tpl->tpl_vars['encode']->value;?>
">Silahkan klik link berikut ini untuk verifikasi email anda</a></multiline>
<p>Atau copy link berikut ke browser anda : <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
register/validate/?ref=<?php echo $_smarty_tpl->tpl_vars['encode']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
register/validate/?ref=<?php echo $_smarty_tpl->tpl_vars['encode']->value;?>
</a></p>
<p>Untuk informasi lebih lanjut, silahkan kunjungi <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
">e-tobacco-control</a></u></p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="w580" height="10" width="580"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </layout>
                                                                                                 
                                                    </repeater>
                                                </td>
                                                <td class="w30" width="30"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </td>
                                </tr>
                                <tr><td class="w640" bgcolor="#ffffff" height="15" width="640"></td></tr>
                                                                                        
                                <tr>
                                    <td class="w640" width="640">
                                        <table id="footer" class="w640" cellpadding="0" cellspacing="0" bgcolor="#999999" border="0" width="640">
                                            <tbody>
                                                <tr>
                                                    <td class="w30" width="30"></td>
                                                    <td class="w580 h0" height="5" width="360"></td>
                                                    <td class="w0" width="60"></td>
                                                    <td class="w0" width="160"></td>
                                                    <td class="w30" width="30"></td>
                                                </tr>
                                                <tr>
                                                    <td class="w30" width="30"></td>
                                                    <td class="w580" valign="top" width="360">
                                                        <span class="hide"><p id="permission-reminder" class="footer-content-left" align="left"></p></span>
                                                        <p class="footer-content-left" align="left"><preferences lang="en" >NAPZA</preferences> | <unsubscribe>2014</unsubscribe></p>
                                                    </td>
                                                    <td class="hide w0" width="60"></td>
                                                    <td class="hide w0" valign="top" width="160">
                                                        <p id="street-address" class="footer-content-right" align="right"></p>
                                                    </td>
                                                    <td class="w30" width="30"></td>
                                                </tr>
                                                <tr>
                                                    <td class="w30" width="30"></td>
                                                    <td class="w580 h0" height="15" width="360"></td>
                                                    <td class="w0" width="60"></td>
                                                    <td class="w0" width="160"></td>
                                                    <td class="w30" width="30"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr><td class="w640" height="60" width="640"></td></tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
<?php }} ?>
