/* global paging module */
$(document).on('click','.buttonprevValidasi', function(){
	var pid = $('.hiddenpid').val();
	var param = $('.hiddenparam').val();
	if (pid !=''){
		
		if (pid != 1){
			var paging = parseInt(pid)-1;
			window.location.href="?param="+param+"&"+"pid="+paging;
		}else{
			alert('Halaman tidak tersedia');
			return false;
		}
	}
	
})
	
$(document).on('click','.buttonnextValidasi', function(){
	var pid = $('.hiddenpid').val();
	var param = $('.hiddenparam').val();
	if (pid !=''){
		
		var jumlah = $('.hiddenrecord').val();
		var pageTotal = Math.ceil(jumlah/100);
		
		if (pid < pageTotal){
			var paging = parseInt(pid)+1;
			window.location.href="?param="+param+"&"+"pid="+paging;
		
		}else{
			alert('Halaman tidak tersedia');
			return false;
		}
	}
	
})

$(document).on('click','.buttonprev', function(){
	var pid = $('.hiddenpid').val();
	if (pid !=''){
		
		if (pid != 1){
			var paging = parseInt(pid)-1;
			window.location.href="?pid="+paging;
		}else{
			alert('Halaman tidak tersedia');
			return false;
		}
	}
	
})
	
$(document).on('click','.buttonnext', function(){
	var pid = $('.hiddenpid').val();
	if (pid !=''){
		
		var jumlah = $('.hiddenrecord').val();
		var pageTotal = Math.ceil(jumlah/100);
		
		if (pid < pageTotal){
			var paging = parseInt(pid)+1;
			window.location.href="?pid="+paging;
		
		}else{
			alert('Halaman tidak tersedia');
			return false;
		}
	}
	
})

/* helper ajax */

$(document).on('click', '.checkbox', function()
{
	var check = $(this).attr('checked');
	var modParam = $(this).attr('name');
	var value = $(this).val();
	if ((check == 'checked') || (check == true))
	{
		$.post('../../function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam}, function(data){
		
		})

	}else{
		$.post('../../function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam}, function(data){
		})
	}
	
});

function updateCheckbox(){ 
	var allVals = '';
	var i = 1;
	
	$('.checkbox:checked').each(function() {
	  
		if (i == 1)
		{
			allVals+=$(this).val();  
		}else{
			allVals+=","+$(this).val();
		}
	  
		i++;
	});
	$('#t').val(allVals)
	return allVals;
}
	
function updateCheckboxEmpty() {   
	var allVals = '';
	var i = 1;
	
	$('.checkbox:checked').each(function() {
	  
		if (i == 1)
		{
			allVals+=$(this).val();  
		}else{
			allVals+=","+$(this).val();
		}
	  
		i++;
	});
	$('#t').val(allVals)
	return allVals;
}

// add multiple select / deselect functionality
$(document).on('click','#pilihHalamanIni', function () {
	$('.checkbox').attr('checked', '1');
	var panjang=$(".checkbox:checked").length;
	var value =updateCheckbox();
	var modParam = $('.checkbox').attr('name');
	
	$.post('../../function/phpajax/ajax.php', {aid:value, parameter:'add', mod:modParam, type:'array'}, function(data){
					
	})
});
			
			
$(document).on('click', '#kosongkanHalamanIni', function () {
	var panjang=$(".checkbox:checked").length;
	var value =updateCheckboxEmpty();
	var modParam = $('.checkbox').attr('name');
	
	$.post('../../function/phpajax/ajax.php', {aid:value, parameter:'del', mod:modParam, type:'array'}, function(data){
					
	$('.checkbox').prop('checked', false);
	})
});

$(document).on('click', '.filter', function(){
	var aset_id = $('.aset_id').val();
	var aset_name = $('.aset_name').val();
	var no_kontrak = $('.no_kontrak').val();
	var thn_perolehan = $('.thn_perolehan').val();
	var lda_kelompok = $('#lda_kelompok').val();
	var entri_lokasi = $('#entri_lokasi').val();
	var lda_skpd = $('#lda_skpd').val();
	var lda_ngo = $('#lda_ngo').val();
	
	if (aset_id == "" || aset_name == "" || no_kontrak == "" || thn_perolehan == "" || lda_kelompok == "" ||
		entri_lokasi == "" || lda_skpd == "" || lda_ngo == ""){
		
		if (confirm('Filter isian kosong ?')) { 
			// do nothing, redirect to next page
		}else{
			return false;
		}
		
	}

});

$(document).ready(function(){
 $("#no_dokumen").change(function(){ 
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html("<img src='jquery/loader.gif' title='Proses' alt='proses'/> checking ...");	
    var no_dokumen  = $("#no_dokumen").val();     
    $.ajax({
     type:"POST",
     url:"../../function/phpajax/cekGudang.php",    
     data: "no_dokumen=" + no_dokumen,
     success: function(data){                 
       if((data==0) && (no_dokumen!='')){
          $("#pesan").html('<img src="../../function/phpajax/images/tick.png" title="OK" alt="OK"> Nomor Dokumen belum digunakan');
 	     $('#simpan').removeAttr('disabled');
		 // $('#simpan').css("background","#386B12");
       }  
       else if((data!=0) && (no_dokumen!='')){
          $("#pesan").html('<img src="../../function/phpajax/images/cross.png" title="Terpakai" alt="Terpakai">Nomor Dokumen sudah digunakan');       
 	      $('#simpan').attr('disabled','disabled');
       }else{
          $("#pesan").html('<img src="../../function/phpajax/images/cross.png" title="a" alt="a">Nomor Dokumen harus diisi');
          $('#simpan').attr('disabled','disabled');
       }
     }
    }); 
	})  

});

$(document).ready(function(){
 $("#no_ba").change(function(){ 
		// tampilkan animasi loading saat pengecekan ke database
    $('#pesan').html("<img src='jquery/loader.gif' title='Proses' alt='proses'/> checking ...");	
    var no_ba  = $("#no_ba").val();     
    $.ajax({
     type:"POST",
     url:"../../function/phpajax/cekPemeriksaanGudang.php",    
     data: "no_ba=" + no_ba,
     success: function(data){                 
       if((data==0) && (no_ba!='')){
          $("#pesan").html('<img src="../../function/phpajax/images/tick.png" title="OK" alt="OK"> Nomor BAP belum digunakan');
 	     $('#simpan').removeAttr('disabled');
		 // $('#simpan').css("background","#386B12");
       }  
       else if((data!=0) && (no_ba!='')){
          $("#pesan").html('<img src="../../function/phpajax/images/cross.png" title="Terpakai" alt="Terpakai">Nomor BAP sudah digunakan');       
 	      $('#simpan').attr('disabled','disabled');
       }else{
          $("#pesan").html('<img src="../../function/phpajax/images/cross.png" title="a" alt="a">Nomor BAP harus diisi');
          $('#simpan').attr('disabled','disabled');
       }
     }
    }); 
	})  

});
	 
function requiredFilter(jenisaset=true, satker=true, satkerid="kodeSatker")
{

	if (jenisaset){
		var jenisaset1 = $('.jenisaset1').is(":checked")
	    var jenisaset2 = $('.jenisaset2').is(":checked")
	    var jenisaset3 = $('.jenisaset3').is(":checked")
	    var jenisaset4 = $('.jenisaset4').is(":checked")
	    var jenisaset5 = $('.jenisaset5').is(":checked")
	    var jenisaset6 = $('.jenisaset6').is(":checked")

	    if (jenisaset1 == false && jenisaset2 == false && jenisaset3 == false && jenisaset4 == false && jenisaset5 == false && jenisaset6 == false){
	        alert('Pilih Jenis Aset');
	        return false;
	    }
	}


	if (satker){

		var kode = $('#'+satkerid).val();
		console.log(kode);
		
		if (kode==false || kode==""){
			alert('Pilih Satker');
			return false;
		}

	}
	

}

function dTableParam(idTable=false, urlApi=false, numCol=false)
{
	$('#'+idTable).dataTable({

        "aoColumnDefs": [
             { "aTargets": [2] }
        ],
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false,"sClass": "checkbox-column" },
           	{"bSortable": true},
           	{"bSortable": true},
           	{"bSortable": true},
           	{"bSortable": true},
           	{"bSortable": true},
           	{"bSortable": true},
           	{"bSortable": true}
        ],
        "sPaginationType": "full_numbers",
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": basedomain+"/api_list/"+urlApi
	});
}

function log(){
	alert('ada');
}