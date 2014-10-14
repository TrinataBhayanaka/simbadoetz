<?php

function selectSatker(){

	global $url_rewrite;

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
		<span class="span2">Kode Satker </span>
		<input id="satker1" name="upb" type="hidden" style="width:300px"/>
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
		<input id="aset" name="upb" type="hidden" style="width:300px"/>
	</li>
	
	
	<?php

}

?>