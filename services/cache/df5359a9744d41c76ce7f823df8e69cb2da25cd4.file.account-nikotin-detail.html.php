<?php /* Smarty version Smarty-3.1.15, created on 2015-09-14 00:52:58
         compiled from "app/view/account-nikotin-detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1793835355f5a801064c11-09982739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df5359a9744d41c76ce7f823df8e69cb2da25cd4' => 
    array (
      0 => 'app/view/account-nikotin-detail.html',
      1 => 1442166775,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1793835355f5a801064c11-09982739',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_55f5a8010dfcf1_97194285',
  'variables' => 
  array (
    'basedomain' => 0,
    'id' => 0,
    'ind' => 0,
    'kemasan' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f5a8010dfcf1_97194285')) {function content_55f5a8010dfcf1_97194285($_smarty_tpl) {?>
<script type="text/javascript">

  

    $(document).on('change', '.pilihprov', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajax',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          $.each(data.res, function(i,val){

            html += "<option value='"+val.kode_wilayah+"'>"+val.nama_wilayah+"</option>";

          })

          $('.pilihkab').html(html);
        } 
        
      }, "JSON")  

    })
  
</script>

<br>

<section>
    <div class="container">  
      <div class="center">
  <h2>Preview Pelaporan Nikotin & TAR</h2>
            <p class="lead">&nbsp;</p>
  </div>
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">
<div class="container">  
        <button id="btn-dis" class="btn btn-info" type="button" onclick="history.back()">
        <i class="fa fa-save"></i>
        Kembali ke daftar pelaporan
        </button>
        <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin/?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><button id="btn-dis" class="btn btn-warning" type="button" onclick="">
        <i class="fa fa-save"></i>
        Edit data
        </button></a>
  </div>
<div class="content-container">

  <div class="row" style="margin-top:10px;">
      <div class="col-md-12">
        <div class="span6" style="border:1px solid #bbb;border-radius:10px;padding:10px 20px 10px 20px;">
          <table class="table">
            
            <thead>
            <tr>
              <th align="center">Item</th>
              <th align="center">Data</th>
              
            </tr>
            </thead>
            <tbody>
            
            <tr>
              <td>Nama Perusahaan</td>
              <td><input type="text" name="merek" class="form-control namaprodusen" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['namaIndustri'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kecamatan</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['kecamatan'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kelurahan/Desa</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['desa'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kode Pos</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['kodePos'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Nama Jalan , RT RW</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['jalanRTRW'];?>
" disabled/></td>
            </tr>
             <tr>
              <td>Nomor NPPBKC</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['noNPPBKC'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Merek Rokok</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['merek'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Jenis</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['d_jenisRokok'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Isi/Kemasan</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['isiKemasan'];?>
 / <?php echo $_smarty_tpl->tpl_vars['kemasan']->value['d_isiKemasan'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kode Produksi</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['kodeProduksi'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Nomor / Kode sampel</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['kodeSample'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Nama Laboratorium</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['lab_nama'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Alamat Laboratorium</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['lab_alamat'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Penanggungjawab Laboratorium</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['lab_account'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Nomor Lap Hasil Uji/Sertifikat</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['noSertifikat'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Tanggal pengujian</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['tanggalUji'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kadar Nikotin</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['kadarNikotin'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kadar Tar Coresta/Tar ISO</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['kadarTar'];?>
" disabled/></td>
            </tr>
            <tr>
              <td>Kadar Tar SNI/ Tar Kretek</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['kadarKretek'];?>
" disabled/></td>
            </tr>

            <tr>
              
              <td>Surat Pengantar</td>
              <td><div class="col-sm-12">

                  <div class="col-sm-3">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['sertifikat'];?>
" width="100%">
                  </div>
                  
                </div></td>
              
            </tr>
            </tbody>
          </table>
          
        </div>
      </div>
    </div>


      
</div>

</form>
</div>
  
  
</section>
<?php }} ?>
