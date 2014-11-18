$(document).ready(function() {
        $("#add, .check ").click(function() {
           // $('#mytable tbody>tr:last').clone(true).insertAfter('#mytable tbody>tr:last');
              var koordinat =$("#koordinat").val();
                var koordinat = parseInt(koordinat)+1;
                var e="<tr><td width=\"3%\" >"+koordinat +"</td>\n\
                                    <td><input type='text' name='p_koordinat_bujur_a' value='' maxlength='2' id='posisiKolom6' size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_bujur_b' value='' maxlength='2' id='posisiKolom7' size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_bujur_c' value='' maxlength='2' id='posisiKolom8' size='2'/></td>\n\
                                    <td width=\"7%\"><input type='text' name='p_koordinat_bujur_d' value='' maxlength='2' id='posisiKolom9' size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_lintang_a' value='' maxlength='2' id='posisiKolom10' size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_lintang_b' value='' maxlength='2' id='posisiKolom11' size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_lintang_c' value='' maxlength='2' id='posisiKolom12'size='2'/></td>\n\
                                    <td><input type='text' name='p_koordinat_lintang_d' value='' maxlength='2' id='posisiKolom13'  size='2'/></td><tr>";
                     
              $("#koordinat ").val(koordinat )
            $('#mytable').append(e);
            return false;
        });
    });
    
$(document).ready(function() {
        $("#add2, .check2 ").click(function() {
         //$('#mytable2 tr:last').clone(true).insertAfter('#mytable2 tr:last');
         var nomor =$("#jml_foto").val();
         var nomor= parseInt(nomor)+1;
         var c="<tr><td width=\"3%\" >"+nomor+"</td><td>\n\
                        <input type='radio' name='name[]' size='2'/>\n\
                        </td><td><input type='file' name='p_foto_aset' size='25'/>\n\
                        </td><td>\n\
                        </td></tr>";
            $("#jml_foto").val(nomor)
            $('#mytable2').append(c);
            return false;
        });
    });

$(document).ready(function() {
        $("#add3, .check2 ").click(function() {
        //    $('#mytable3 tr:last').clone(true).insertAfter('#mytable3 tr:last');
        var nota =$("#nota").val();
         var nota= parseInt(nota)+1;
         var d="<tr><td width=\"3%\">"+nota+"</td><td>\n\
         <input type='radio' name='name[]' size='2'/></td>\n\
         <td><input type='file' name='name[]' size='25'/><br /><br />\n\
         No. Nota Aset <input type='text' name='p_no_nota_aset' size='18'></td><tr>";
                    
            $("#nota").val(nota)
            $('#mytable3').append(d);
        
        
            return false;
        });
    });
