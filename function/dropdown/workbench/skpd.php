<html>
     
     <head>
          <link rel="stylesheet" href="lib/simbada.css" type="text/css" media="screen"/>     
          <script type="text/javascript" src="lib/ajax.js"></script>
          <script type="text/javascript" src="lib/simpul_skpd.js"></script>
		  <script type="text/javascript" src="lib/tes.js"></script>
		  <script type="text/javascript">
			function recp(id) {
			id=document.getElementById('search').value;
			  $('#myStyle').load('search_skpd.php?id=' + id);
			}
			</script>
          <script type="text/javascript">
		  function SelectAllChild(id) {
                                  var frm = document.forms[0]; //cek child
                                   for (i = 0; i < frm.elements.length; i++) {
								  var trim=frm.elements[i].value.length;
                                      if (frm.elements[i].value == id.value) {
									  for (j = 0; j < frm.elements.length; j++) {
										  if (frm.elements[j].value.substr(0,trim) == frm.elements[i].value) {
                                          if (frm.elements[j].disabled == false)
                                              frm.elements[j].checked = id.checked;
											  
											  //alert(j + frm.elements[j].value + '==' + frm.elements[i].value);
												//uncek parent
												for (k = 0; k < frm.elements.length; k++) {
												var fparent = frm.elements[k].value.length;
													if (frm.elements[i].value.substr(0,fparent) == frm.elements[k].value) {
													if (frm.elements[k].checked == true)
													frm.elements[k].checked = id.checked;
													
													}
												}
											}
										}
										//alert(trim);
                                      }
                                  }
                              }
		  </script>
     </head>
     <body>
             <style>
        .tabel th {
        background-color: #eeeeee;
        border: 1px solid #dddddd;
        }
        .tabel td {
        border: 1px solid #dddddd;
        }
        </style>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include "config/database.php";
$sql="SELECT * FROM satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";

$result = mysql_query($sql);


echo "<form method='post' action='proses_cek.php'>";
echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

echo " <tr>
        <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
        <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search\">
        <input type=\"button\" value=\"Cari\" onClick=\"recp()\">
        </th>
        </tr>
        <tr>

        <th width=\"100px\">&nbsp;</th>
        <th width=\"150px\"align=\"center\"><b>Kode</b></th>
        <th width=\"500px\" align=\"left\"><b>Nama</b></th>
        </tr>
        <tr>
        <td colspan=\"3\"></td>
        </tr>
		<tbody id='myStyle'>";

while($row = mysql_fetch_object($result))
{
     $kode=$row->KodeSektor;
     $uraian=$row->NamaSatker;
     $kode_for_js="kelompok_row_1|$kode|1";
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"checkbox\" id=\"$kode\" name=\"kelompok[]\" value=\"$kode\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<td>BID $kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
      
     
}
echo "	</tbody>
		</table>";
echo "</form>";
        

?>
        <table>
             <tbody id="masuk">
             </tbody>
        </table>  
     </body>
</html>