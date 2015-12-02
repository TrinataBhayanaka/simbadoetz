<?php /* Smarty version Smarty-3.1.15, created on 2015-09-09 17:19:31
         compiled from "app/view/account-industri-preview.html" */ ?>
<?php /*%%SmartyHeaderCode:1467286394546efb5a9f0d79-23787993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84703f4be9c645949c56a50f2798174541094975' => 
    array (
      0 => 'app/view/account-industri-preview.html',
      1 => 1441793964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1467286394546efb5a9f0d79-23787993',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_546efb5aa53944_85247438',
  'variables' => 
  array (
    'basedomain' => 0,
    'data' => 0,
    'kabupaten' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_546efb5aa53944_85247438')) {function content_546efb5aa53944_85247438($_smarty_tpl) {?>
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
  <h2>Preview Informasi Produsen / Importir</h2>
            <p class="lead">&nbsp;</p>
  </div>
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">

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
              <td><input type="text" name="merek" class="form-control namaprodusen" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaIndustri'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>NPWP Perusahaan</td>
              <td><input type="text" name="produsen" class="form-control namaprodusen" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['npwp'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
             
              <td>Nama Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaPimpinan'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
             
              <td>No KTP Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noKTP'];?>
" disabled/></td>
              <td></td>
            </tr>
            
            <tr>
              
              <td>Alamat Penanggungjawab</td>
              <td><input type="text" name="jenis" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['alamatPimpinan'];?>
" disabled/></td>
              <td></td>
            </tr>
            
            <tr>
              
              <td>Kabupaten/Kotamadya</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['kabupaten']->value['nama_wilayah'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
             
              <td>Kecamatan</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['kecamatan'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>Kelurahan/Desa</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['desa'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>Kode Pos</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['kodePos'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
             
              <td>Nama Jalan , RT RW</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['jalanRTRW'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>No Telepon</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noTelepon'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>No Fax</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noFax'];?>
" disabled/></td>
              <td></td>
            </tr>
            <tr>
              
              <td>Alamat email</td>
              <td><input type="text" name="kataPromotif" class="form-control jenisrokok" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" disabled/></td>
              <td></td>
            </tr>
            </tbody>
          </table>
          
        </div>
      </div>
    </div>


      <br>
      <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">
      <button id="btn-dis" class="btn btn-warning" type="button">
      <i class="fa fa-save"></i>
      Kembali
      </button>
      </a>
      <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
      <button id="btn-dis" class="btn btn-info" type="button">
      <i class="fa fa-save"></i>
      Lanjutkan Ke Form Pabrik
      </button></a>
      
      
</div>

</form>
</div>
</section><?php }} ?>
