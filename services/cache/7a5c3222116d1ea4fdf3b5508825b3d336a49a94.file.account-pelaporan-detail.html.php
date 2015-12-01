<?php /* Smarty version Smarty-3.1.15, created on 2015-09-14 00:53:21
         compiled from "app/view/account-pelaporan-detail.html" */ ?>
<?php /*%%SmartyHeaderCode:1238402587548126d1c012d8-42832380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a5c3222116d1ea4fdf3b5508825b3d336a49a94' => 
    array (
      0 => 'app/view/account-pelaporan-detail.html',
      1 => 1442166799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1238402587548126d1c012d8-42832380',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_548126d1c4d1d1_33488520',
  'variables' => 
  array (
    'basedomain' => 0,
    'id' => 0,
    'ind' => 0,
    'kemasan' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_548126d1c4d1d1_33488520')) {function content_548126d1c4d1d1_33488520($_smarty_tpl) {?>
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
  <h2>Preview Pelaporan Kemasan</h2>
            <p class="lead">&nbsp;</p>
  </div>
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">
<div class="container">  
        <button id="btn-dis" class="btn btn-info" type="button" onclick="history.back()">
        <i class="fa fa-save"></i>
        Kembali ke daftar Pelaporan
        </button>
        <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan/?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
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
              
              <td>NPWP Perusahaan</td>
              <td><input type="text" name="produsen" class="form-control namaprodusen" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['npwp'];?>
" disabled/></td>
              
            </tr>
            <tr>
             
              <td>Nama Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['namaPimpinan'];?>
" disabled/></td>
              
            </tr>
            <tr>
             
              <td>No KTP Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['noKTP'];?>
" disabled/></td>
              
            </tr>
            
            <tr>
              
              <td>Alamat Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['alamatPimpinan'];?>
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
              
              <td>No Telepon</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['ind']->value['noTelepon'];?>
" disabled/></td>
              
            </tr>
            <tr>
              
              <td>No Fax</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['noFax'];?>
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
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['isi'];?>
 / <?php echo $_smarty_tpl->tpl_vars['kemasan']->value['d_isiKemasan'];?>
" disabled/></td>
              
            </tr>
            <tr>
              
              <td>Bentuk Kemasan</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['d_bentukKemasan'];?>
" disabled/></td>
              
            </tr>
            <tr>
              
              <td>Jenis Gambar</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['d_jenisGambar'];?>
" disabled/></td>
              
            </tr>

            <tr>
              
              <td>Tulisan peringatan kesehatan</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['title'];?>
" disabled/></td>
              
            </tr>
            <tr>
              
              <td>Surat Pengantar</td>
              <td><div class="col-sm-12">

                  <div class="col-sm-3">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['suratPengantar'];?>
" width="100%">
                  </div>
                  
                </div></td>
              
            </tr>
            <tr>
              
              <td>Foto Kemasan</td>
              <td>
                <div class="col-sm-12">
                  
                  <div class="col-sm-3">
                    Foto depan
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoDepan'];?>
" width="100%">
                  </div>
                  <div class="col-sm-3">
                    Foto belakang
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoBelakang'];?>
" width="100%">
                  </div>
                  <div class="col-sm-3">
                    Foto Kiri
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoKiri'];?>
" width="100%">
                  </div>
                  <div class="col-sm-3">
                    Foto Kanan
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoKanan'];?>
" width="100%">
                  </div>

                </div>
                <div class="col-sm-12">

                  <div class="col-sm-3">
                    Foto Atas
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoAtas'];?>
" width="100%">
                  </div>
                  <div class="col-sm-3">
                    Foto Bawah
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasan']->value['fotoBawah'];?>
" width="100%">
                  </div>
                  
                  
                </div>
              </td>
              
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
