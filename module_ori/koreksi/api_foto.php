<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
  include "../../config/config.php";  
  
  
  $foto=$_GET['foto'];
  $fotonota=$_GET['nota'];
  //$no=$_GET['no'];
  
  if(isset($foto)){
       
       $foto=  urldecode($foto);
       $path="$path$foto";
       $tmp=explode("/",$foto);
       $aset_id=$tmp[2];
       
       unlink($path);
       $query_delete="delete from Foto where Aset_ID='$aset_id' and DataFoto='$foto'";
        $result=mysql_query($query_delete) or die(mysql_error());
       
        
        $query="select DataFoto from Foto where Aset_ID='$aset_id'";
       $result=mysql_query($query) or die(mysql_error());
       $no=0;
       
       
       
        echo "
                                                    <tr>
                                                        <td style=\"font-size:14px;font-weight:bold;\" colspan=4 width=\"10%\" >Foto Aset</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type=\"button\" onclick=\"add_foto_pengadaan('jml_foto','isi_foto');\" value=\"Tambah Foto\"></td>
                                                    </tr>";
        
       while($row=  mysql_fetch_object($result)){
            $DataFoto=$row->DataFoto;
             $value=$DataFoto;
            $data=explode("/",$DataFoto);
             $data=$data[3];
            $no++;
           echo "<tr>
                              <td>$no.</td>
                              <td coslpan=\"3\"><img src=\"$url_rewrite/$value\" width=\"60px\" height=\"60px\"></td>
                              <td><input type=\"button\" value=\"Remove\" onclick='remove_fotokoreksi(\"$value \")'></td>
                             
                    </tr>";
           
       }
       $no++;
       echo "<tr>
                                                        <td width=\"3%\" id=\"foto$no\" >$no </td>
                                                        <td><input type=\"radio\" name=\"radio_foto[]\" size='2'/></td>
                                                        <td><input type=\"file\" name=\"p_foto_aset[]\" size='25'/></td>
                                                    </tr>";
       echo "<input type=\"hidden\" id=\"jml_foto\" value=\"$no\">";
       
       
  }
  else if(isset($fotonota)){
       
       $foto=  urldecode($fotonota);
       $path="$path$foto";
       $tmp=explode("/",$fotonota);
       $aset_id=$tmp[2];
       
       
       unlink($path);
       $query_delete="delete from FotoNota where Aset_ID='$aset_id' and Foto_Path='$foto'";
        $result=mysql_query($query_delete) or die(mysql_error());
        
       $query="select Foto_Path,No_Nota from FotoNota where Aset_ID='$aset_id'";
       $result=mysql_query($query) or die(mysql_error());
       $no=0;
       
       
       
        echo "
                                                    <tr>
                                                        <td style=\"font-size:14px;font-weight:bold;\" colspan=4 width=\"10%\" >Nota Aset</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type=\"button\" onclick=\"add_nota_pengadaan('jml_nota','isi_nota');\" value=\"Tambah Foto\"></td>
                                                    </tr>";
        
       while($row=  mysql_fetch_object($result)){
            $DataFoto=$row->Foto_Path;
            $No_Nota=$row->No_Nota;
            $value=$DataFoto;
             $data=explode("/",$DataFoto);
             $data=$data[3];
            $no++;
           echo "<tr>
                              <td>$no.</td>
                              <td><img src=\"$url_rewrite/$value\" width=\"60px\" height=\"60px\"></td>
            
                              <td><input type=\"button\" value=\"Remove\" onclick='remove_fotokoreksinota(\"$DataFoto\");'>
              <br /><br />No.  <input type=\"text\" name=\"p_no_nota_aset[]\" size='18' value=\"$No_Nota\"></td>
                    </tr>";
           
       }
       $no++;
       echo "<tr>
                                                        <td width=\"3%\" id=\"foto$no\" >$no </td>
                                                        <td><input type=\"radio\" name=\"radio_foto[]\" size='2'/></td>
                                                        <td><input type=\"file\" name=\"p_foto_aset[]\" size='25'/></td>
                                                    </tr>";
       echo "<input type=\"hidden\" id=\"jml_foto\" value=\"$no\">";
  }
?>
