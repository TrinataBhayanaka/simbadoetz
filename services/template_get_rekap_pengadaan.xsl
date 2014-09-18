
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/data/SKPD">
  <html>
  <body>
    <center>
    <table border="1" style="border-collapse:collapse;">
      <tr>
        <td  align="center"><xsl:value-of select="HeaderTitle"/><br></br>
        
        <xsl:value-of select="HeaderProvinsi"/><br></br>
        <xsl:value-of select="HeaderTahun"/></td>
    </tr>
    </table>
    </center>
    <xsl:for-each select="Content">
    
    <table>
      <tr>
        <td>SKPD</td>
        <td><b>: <xsl:value-of select="NamaSkpd"/></b></td>
      </tr>
      <tr>
        <td>KABUPATEN / KOTA</td>
        <td><b>: <xsl:value-of select="Kabupaten"/></b></td>
      </tr>
      <tr>
        <td>PROVINSI</td>
        <td><b>: <xsl:value-of select="Provinsi"/></b></td>
      </tr>
    </table>
    
 
  <table border="1" cellpadding="5px">
    <tr bgcolor="#c3c3c3">
      <th width="150px">Golongan</th>
      <th width="150px">Bidang</th>
          <th width="100px">Nama Bidang</th>
          <th width="400px">Jumlah Awal</th>
          <th width="150px">Harga Awal</th>
          <!--<th width="150px">Jumlah Berkurang</th>
          <th width="150px">Harga Berkurang</th>
          <th width="150px">Jumlah Akhir</th>-->
          <th width="150px">Harga Akhir</th>
          
    </tr>
    
    <xsl:for-each select="Golongan_01">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_02">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_03">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_04">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_05">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_06">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
    <xsl:for-each select="Golongan_07">  
    <tr style="line-height:15px">
      <td><xsl:value-of select="Golongan"/></td>
      <td><xsl:value-of select="Bidang"/></td>
          <td><xsl:value-of select="NamaBidang"/></td>
          <td><xsl:value-of select="JumlahAwal"/></td>
          <td><xsl:value-of select="HargaAwal"/></td>
          <!--<td><xsl:value-of select="JumlahBerkurang"/></td>
          <td><xsl:value-of select="HargaBerkurang"/></td>
          <td><xsl:value-of select="JumlahAkhir"/></td>-->
          <td><xsl:value-of select="HargaAkhir"/></td>
    </tr>
    </xsl:for-each>
  </table>
  </xsl:for-each>
    <br></br><br></br>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>

