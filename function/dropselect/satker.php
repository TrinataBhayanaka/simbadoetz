
<?php

function selectSatker($name,$size=300,$br=false,$upd=false){

	global $url_rewrite;
	if($br) $span = "span2"; else {$span="";$enter="<br>";}
	?>
	<script type="text/javascript">
	$(document).ready(function() {
	//fungsi dropselect
				$("#<?=$name?>").select2({
               		placeholder: "Pilih Unit Pengelola Barang",
				    minimumInputLength: 2,
				    ajax: {
				        url: "<?=$url_rewrite?>/function/api/satker.php",
				        dataType: 'json',
				        type: "GET",
				        quietMillis: 50,
				        data: function (term) {
				            return {
				                term: term
				            };
				        },
				        results: function (data) {
				            return {
				                results: $.map(data, function (item) {
				                    return {
				                        text: item.kode+" "+item.NamaSatker,
				                        id: item.kode
				                    }	
				                })
				            };
				        }
				    }
				});
				var id = "<?=$upd?>";
				if(id)
				{
					$("#<?=$name?>").select2('data', {id: id, text: id});	
				}	
				

	} );
	</script>
	<li>
		<span class="<?=$span?>">Kode Satker </span><?=$enter?>
		<input id="<?=$name?>" name="<?=$name?>" type="hidden" style="width:<?=$size?>px"/>
	</li>
	
	
	<?php

}

function selectAset($name,$size=300,$br=false,$upd=false){

	global $url_rewrite;
	if($br) $span = "span2"; else {$span="";$enter="<br>";}
	?>
	<script type="text/javascript">
	$(document).ready(function() {
	//fungsi dropselect
				$("#<?=$name?>").select2({
               		placeholder: "Pilih Jenis Aset",
				    minimumInputLength: 2,
				    ajax: {
				        url: "<?=$url_rewrite?>/function/api/aset.php",
				        dataType: 'json',
				        type: "GET",
				        quietMillis: 50,
				        data: function (term) {
				            return {
				                term: term
				            };
				        },
				        results: function (data) {
				            return {
				                results: $.map(data, function (item) {
				                    return {
				                        text: item.Kode+" "+item.Uraian,
				                        id: item.Kode
				                    }
				                })
				            };
				        }
				    }
				});

			var id = "<?=$upd?>";
				if(id)
				{
					$("#<?=$name?>").select2('data', {id: id, text: id});	
				}	

	} );
	</script>
	<li>
		<span class="<?=$span?>">Jenis Aset </span><?=$enter?>
		<input id="<?=$name?>" name="<?=$name?>" type="hidden" style="width:<?=$size?>px"/>
	</li>
	
	
	<?php

}


?>
