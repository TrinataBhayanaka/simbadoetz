<?php

function selectSatker($name,$size=300,$br=false){

	global $url_rewrite;
	if($br) $span = "span2"; else {$span="";$enter="<br>";}
	?>
	<script type="text/javascript">
	$(document).ready(function() {
	//fungsi dropselect
				$("#satker1").select2({
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

	} );
	</script>
	<li>
		<span class="<?=$span?>">Kode Satker </span><?=$enter?>
		<input id="satker1" name="<?=$name?>" value="tae" type="hidden" style="width:<?=$size?>px"/>
	</li>
	
	
	<?php

}

function selectAset(){

	global $url_rewrite;

	?>
	<script type="text/javascript">
	$(document).ready(function() {
	//fungsi dropselect
				$("#aset").select2({
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
	} );
	</script>
	<li>
		<span class="span2">Kode Satker </span>
		<input id="aset" name="upb" type="hidden" class="span3"/>
	</li>
	
	
	<?php

}

?>