/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 var xmlHttp = buatObjekXmlHttp2();
   
   function buatObjekXmlHttp2()
   {
        
      var obj = null;
      if (window.ActiveXObject)
         obj = new ActiveXObject("Microsoft.XMLHTTP");   
      else 
         if (window.XMLHttpRequest)
            obj = new XMLHttpRequest();
     
      // Cek isi xmlHttp
      if (obj == null)
         document.write(
            "Browser tidak mendukung XMLHttpRequest");      
      return obj;    
      
   }
    function ambilDataPenerimaan(sumber_data, id_elemen)
   { 
      if (xmlHttp != null)
      {
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //  alert(xmlHttp.responseText);
               hasil=id_elemen.split("|");
               tmp_hasil_get=xmlHttp.responseText;
               if(tmp_hasil_get!=""){
                    hasil_get=tmp_hasil_get.split("|");
                    var i=0;
                    panjang=hasil_get.length;
                      for(i=0;i<panjang;i++)
                    {
                        // alert("asdasdsad"+hasil_get[i]);
                         document.getElementById(hasil[i]).value=hasil_get[i];
                    }
               }
            }
         }  
         
         xmlHttp.send(null);
      }
   }
   
   function addDinamis(sumber_data, id_elemen,id_jml,jmlh)
   { 
      if (xmlHttp != null)
      {
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //  alert(xmlHttp.responseText);
                  tmp_hasil_get=xmlHttp.responseText;
                   document.getElementById(id_elemen).innerHTML+=tmp_hasil_get;
                   add_script(tmp_hasil_get);
                    document.getElementById(id_jml).value=jmlh;
            }
         }  
         
         xmlHttp.send(null);
      }
   }
   
   function addDinamisAset(sumber_data, id_elemen)
   { 
      if (xmlHttp != null)
      {
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //  alert(xmlHttp.responseText);
                  tmp_hasil_get=xmlHttp.responseText;
                   document.getElementById(id_elemen).innerHTML=tmp_hasil_get;
                   add_script(tmp_hasil_get);
             }
         }  
         
         xmlHttp.send(null);
      }
   }
   
   
 
   function add_script(strcode) {

var ss = document.createElement('script');

var scripts = new Array();         // Array which will store the script's code
  
  // Strip out tags
  while(strcode.indexOf("<script") > -1 || strcode.indexOf("</script") > -1) {
    var s = strcode.indexOf("<script");
    var s_e = strcode.indexOf(">", s);
    var e = strcode.indexOf("</script", s);
    var e_e = strcode.indexOf(">", e);
    
    // Add to scripts array
    scripts.push(strcode.substring(s_e+1, e));
    // Strip from strcode
    strcode = strcode.substring(0, s) + strcode.substring(e_e+1);
  }
  
  // Loop through every script collected and eval it
  for(var i=0; i<scripts.length; i++) {
    try {
      var tt = document.createTextNode(scripts[i]);
        ss.appendChild(tt);
    }
    catch(ex) {
      // do what you want here when a script fails
    }
  }
  var hh = document.getElementsByTagName('head')[0];
  hh.appendChild(ss);



}


   
   function removefoto(sumber_data, id_elemen)
   { 
      if (xmlHttp != null)
      {
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //  alert(xmlHttp.responseText);
                  tmp_hasil_get=xmlHttp.responseText;
                   document.getElementById(id_elemen).innerHTML=tmp_hasil_get;
                   //add_script(tmp_hasil_get);
             }
         }  
         
         xmlHttp.send(null);
      }
   }