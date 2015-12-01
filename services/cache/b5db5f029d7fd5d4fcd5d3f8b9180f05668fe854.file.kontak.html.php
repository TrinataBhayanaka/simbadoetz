<?php /* Smarty version Smarty-3.1.15, created on 2014-11-16 10:14:39
         compiled from "app/view/kontak.html" */ ?>
<?php /*%%SmartyHeaderCode:120061447154477d9f679844-87386287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5db5f029d7fd5d4fcd5d3f8b9180f05668fe854' => 
    array (
      0 => 'app/view/kontak.html',
      1 => 1416107677,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120061447154477d9f679844-87386287',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54477d9f689de5_43860057',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54477d9f689de5_43860057')) {function content_54477d9f689de5_43860057($_smarty_tpl) {?><section id="contact-info">
        <div class="center">                
            <h2>We Are Here</h2>

        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <div class="gmap">
                        
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=JoomShaper,+Dhaka,+Dhaka+Division,+Bangladesh&amp;aq=0&amp;oq=joomshaper&amp;sll=37.0625,-95.677068&amp;sspn=42.766543,80.332031&amp;ie=UTF8&amp;hq=JoomShaper,&amp;hnear=Dhaka,+Dhaka+Division,+Bangladesh&amp;ll=23.73854,90.385504&amp;spn=0.001515,0.002452&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=1073661719450182870&amp;output=embed"></iframe>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 map-content">
                        <ul class="row">
                            <li class="col-sm-11">
                                <address>
                                    
                                    <h5>INDONESIA</h5>
                                    <label>Direktorat Pengawasan Narkotika, Psikotropika dan Zat Adiktif (NAPZA)</label>
                                    <br><p>(Directorate of Narcotic, psychotropic and Addictive Substances)</p>
                                    
                                    <p>Jln Percetakan Negara No.23, Gedung F, Lt V<br/>
                                    Telp/Fax: 021-4245523/4244691 (ext. 1075)<br/>
                                    Email: wasnapza@pom.go.id; wasnapza@gmail.com<br/>
                                    <br>
                                    <label>Badan Pengawas Obat dan Makanan Republik Indonesia</label>
                                    <br>
                                    <p>(National Agency of Drug & Food Control Indonesia)</p>
                                    
                                </address>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->
<section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>CONTACT US</h2>
                <p class="lead">Tell us about you </p>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>FULL NAME :</label>
                            <input type="text" name="nama" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>ADDRESS :</label>
                            <input type="text" name="alamat" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>CITY/TOWN :</label>
                            <input type="text" name="kota" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>INSTITUTION/DEPT :</label>
                            <input type="text" name="institusi" class="form-control">
                        </div>    
            <div class="form-group">
                            <label>TELP :</label>
                            <input type="text" name="telp" class="form-control">
                        </div>   
            <div class="form-group">
                            <label>FAX :</label>
                            <input type="text" name="fax" class="form-control">
                        </div> 
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>EMAIL :</label>
                            <input type="text" name="email" class="form-control" required="required">
                        </div>
            <div class="form-group">
                            <label>SUBJECT :</label>
                            <input type="text" name="subjek" class="form-control" required="required">
                        </div>
                        <div class="form-group">
                            <label>MESSAGE :</label>
                            <textarea name="komentar" id="message" required="required" class="form-control" rows="8"></textarea>
                        </div>                        
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg" required="required" value="Send"/>
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->

<?php }} ?>
