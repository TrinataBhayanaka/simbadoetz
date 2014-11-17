   var xmlHttp = buatObjekXmlHttp();
   
   function buatObjekXmlHttp()
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
    function ambilData(sumber_data, id_elemen,id_elemen2)
   { 
      
      if (xmlHttp != null)
      {
             
         var obj = document.getElementById(id_elemen);
         var obj2 = document.getElementById(id_elemen2);
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //  alert(xmlHttp.responseText);
              obj.innerHTML= xmlHttp.responseText;
               obj2.value= xmlHttp.responseText;;
             }
         }  
         
         xmlHttp.send(null);
      }
    
      
   }
   
   function dropDownCheckBox_Kelompok(sumber_data, id_elemen,tbody)
   { 
      if (xmlHttp != null)
      {
         var obj = document.getElementById(id_elemen);
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //obj.innerHTML=xmlHttp.responseText;
             addCheckboxKelompok(xmlHttp.responseText, id_elemen,tbody);
            }
         }  
         
         xmlHttp.send(null);
      }
   }
   
   
    //create function, it expects 2 values.
function insertAfter(newElement,targetElement) {
	//target is what you want it to go after. Look for this elements parent.
	var parent = targetElement.parentNode;
	//if the parents lastchild is the targetElement...
	if(parent.lastchild == targetElement) {
		//add the newElement after the target element.
		parent.appendChild(newElement);
		} else {
		// else the target has siblings, insert the new element between the target and it's next sibling.
		parent.insertBefore(newElement, targetElement.nextSibling);
		}
}
function cek_element(keyword,tbody)
 {
    
          nilai=getElementsByIdStartsWith(tbody, "tr", keyword);
          return nilai
 }
function getElementsByIdStartsWith(container, selectorTag, prefix) {
    var items = [];
    var hasil='';
    var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
    for (var i = 0; i < myPosts.length; i++) {
        //omitting undefined null check for brevity
        if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
            //items.push(myPosts[i]);
            hasil=myPosts[i].id;
        }
    }
       return hasil;
}



function addCheckboxKelompok(content,id_elemen,tbody)
{

    var isi=new String(content);
    var cek=isi.split("~");
	
    var hasil=cek[1].split("+");
    var panjang=hasil.length;
    var k="";
    var keyword="";
    var count=0;
    for(i=0;i<panjang;i++){
         if (hasil[i]!=""){
           var isi_field=hasil[i].split("]");
               if(isi_field[5]!='6' ){
                    
					
                    var parentGuest = document.getElementById(id_elemen);
                    var row = document.createElement("tr");

                    check2=document.createElement("input");
                    check2.setAttribute('type','hidden');
                    check2.setAttribute('name',tbody+'[]');// tambahin
                    check2.setAttribute('id',isi_field[8]);
                    check2.setAttribute('value',isi_field[6]);
					check2.setAttribute('onclick','SelectAllChild_'+tbody+'(this)'); //tambahan
					if (cek[0]==1)
						{
							 check2.setAttribute('checked','true');
						}
            
                     //untuk hiidden field          
                      hidden_prn=document.createElement("input");
                      hidden_prn.setAttribute('type','hidden');
                      hidden_prn.setAttribute('id',"id_parent_"+isi_field[8]);
					  //untuk tipe aset
					   var TipeAset = document.getElementById("TipeAset");
			try{		   
                                 TipeAset.setAttribute('value',isi_field[9]);
                                   
					   var tmpTipeAset=isi_field[9];
					 
					 var hslTipeAset='';
					 if(tmpTipeAset=='A')
						hslTipeAset='Tanah';
					else if(tmpTipeAset=='B')
						hslTipeAset='Peralatan dan Mesin';
					else if(tmpTipeAset=='C')
						hslTipeAset='Gedung dan Bangunan';
					else if(tmpTipeAset=='D')
						hslTipeAset='Jalan, Irigasi dan Jaringan';	
					else if(tmpTipeAset=='E')
						hslTipeAset='Aset Tetap Lain (Buku, Kesenian/Budaya, Hewan/Tanaman)';	
					else if(tmpTipeAset=='F')
						hslTipeAset='Konstruksi Dalam Pengerjaan';	
					
					
					if(hslTipeAset){ document.getElementById(hslTipeAset).selected=true;
					 document.getElementById('idtypeofasset').value=hslTipeAset;
                              }
                              var persediaan=isi_field[10];
                              if(persediaan==0)
                                   document.getElementById("idfixaset_t").checked=true;
                              else
                                   document.getElementById("idfixaset_f").checked=true;
                              
                              var fixedAset=isi_field[11];
                              if(fixedAset==0)
                                  document.getElementById("idsedia_t").checked=true;
                              else
                                   document.getElementById("idsedia_f").checked=true;
					  document.getElementById("idsatuan").value=isi_field[12];
					  var field_parent=isi_field[8].split("_");
			
                      hidden_prn.setAttribute('value',field_parent[0]+"_"+isi_field[5]);      
                     		
                              } catch (e){
                                        TipeAset='';
                                   }
                              
                     //untuk hidden field
                    hidden_nilai=document.createElement("input");
                      hidden_nilai.setAttribute('type','hidden');
                      hidden_nilai.setAttribute('id',"id_nilai_"+isi_field[8]);
                      hidden_nilai.setAttribute('value',isi_field[4]);    
                    
                    alamat=document.createElement("a");
                    //if(isi_field[9]==''){
                              alamat.setAttribute('href', 'javascript:void(0)');
                              alamat.setAttribute('onClick', isi_field[3]);
		//		}
                    alamat.innerHTML=isi_field[4];


                   // cell1 = document.createElement("TD");
                    cell2 = document.createElement("TD");
                    cell2.setAttribute("colspan", "2")
                    cell3 = document.createElement("TD");


                    textnode1=document.createTextNode(isi_field[2]);
                    textnode2=document.createTextNode(isi_field[2]);
                    textnode3=document.createTextNode(isi_field[3]);
                  //  cell1.innerHTML=isi_field[1];
                  //  cell1.appendChild(check2);
                    
                    //untuk hidden field
                  //  cell1.appendChild(hidden_prn);
                  //  cell1.appendChild(hidden_nilai);
                    cell2.innerHTML=isi_field[1];
                    cell2.appendChild(textnode2);
                    cell3.appendChild(alamat);
                    cell3.appendChild(hidden_prn);
                    cell3.appendChild(hidden_nilai);
                    
                   // row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    row.id = isi_field[0];
                 var temporary=new String(isi_field[0]);
                 var h=temporary.split("|");
                 keyword=h[0]+"|"+h[1];
                 if(!document.getElementById(isi_field[0]))
                    {
                         count=count+1;
                         if (count>1)
                              insertAfter(row, tmp);
                         else
                         {
                             insertAfter(row, parentGuest);
                         }
                         hasil_cek=cek_element(keyword,tbody);    
                         tmp=document.getElementById(hasil_cek);
                    }else{
                       hasil_cek=cek_element(keyword,tbody);    
                       tmp=document.getElementById(hasil_cek);
                       count++;
                    }
                    
                   
               }
         }
              
    }
      
       
   
}


//khusus untuk dropdown skpd di page admin

   function dropDownRadioButtonPengadaan_Kelompok(sumber_data, id_elemen,tbody)
   { 
      if (xmlHttp != null)
      {
         var obj = document.getElementById(id_elemen);
         
         xmlHttp.open("GET", sumber_data, true);

         xmlHttp.onreadystatechange = function ()
         {
            if (xmlHttp.readyState == 4 &&
                xmlHttp.status == 200)
            {
               //obj.innerHTML=xmlHttp.responseText;
             addRadioButtonPengadaanKelompok(xmlHttp.responseText, id_elemen,tbody);
            }
         }  
         
         xmlHttp.send(null);
      }
   }
   
   

function addRadioButtonPengadaanKelompok(content,id_elemen,tbody)
{

    var isi=new String(content);
    var cek=isi.split("~");
	
    var hasil=cek[1].split("+");
    var panjang=hasil.length;
    var k="";
    var keyword="";
    var count=0;
    for(i=0;i<panjang;i++){
         if (hasil[i]!=""){
           var isi_field=hasil[i].split("]");
               if(isi_field[5]!='6' ){
                    
					
                    var parentGuest = document.getElementById(id_elemen);
                    var row = document.createElement("tr");
					
					
                    check2=document.createElement("input");
                    check2.setAttribute('type','radio');
                    check2.setAttribute('name',tbody+'[]');// tambahin
                    check2.setAttribute('id',isi_field[8]);
                    check2.setAttribute('value',isi_field[6]);
					check2.setAttribute('onclick','SelectAllChild_'+tbody+'(this)'); //tambahan
					
					
					if (cek[0]==1)
                                                            {
                                                                 check2.setAttribute('checked','true');
                                                            }	
            
                     //untuk hiidden field          
                      hidden_prn=document.createElement("input");
                      hidden_prn.setAttribute('type','hidden');
                      hidden_prn.setAttribute('id',"id_parent_"+isi_field[8]);
					  var field_parent=isi_field[8].split("_");
           
                      hidden_prn.setAttribute('value',field_parent[0]+"_"+isi_field[5]);      
                     
                     //untuk hidden field
                    hidden_nilai=document.createElement("input");
                      hidden_nilai.setAttribute('type','hidden');
                      hidden_nilai.setAttribute('id',"id_nilai_"+isi_field[8]);
                      hidden_nilai.setAttribute('value',isi_field[4]);    
                    
					alamat=document.createElement("a");
					if(isi_field[9]==''){
                    alamat.setAttribute('href', 'javascript:void(0)');
                    alamat.setAttribute('onClick', isi_field[3]);
					}
                    alamat.innerHTML=isi_field[4];
					

                    cell1 = document.createElement("TD");
                    cell2 = document.createElement("TD");
                    cell3 = document.createElement("TD");


                    textnode1=document.createTextNode(isi_field[2]);
                    textnode2=document.createTextNode(isi_field[2]);
                    textnode3=document.createTextNode(isi_field[3]);
                    cell1.innerHTML=isi_field[1];
                    cell1.appendChild(check2);
					
                    
                    //untuk hidden field
                    cell1.appendChild(hidden_prn);
                    cell1.appendChild(hidden_nilai);
                    
                    cell2.innerHTML=isi_field[1];
                    cell2.appendChild(textnode2);
                    cell3.appendChild(alamat);
                    row.appendChild(cell1);
                    row.appendChild(cell2);
                    row.appendChild(cell3);
                    row.id = isi_field[0];
                 var temporary=new String(isi_field[0]);
                 var h=temporary.split("|");
                 keyword=h[0]+"|"+h[1];
                 if(!document.getElementById(isi_field[0]))
                    {
                         count=count+1;
                         if (count>1)
                              insertAfter(row, tmp);
                         else
                         {
                             insertAfter(row, parentGuest);
                         }
                         hasil_cek=cek_element(keyword,tbody);    
                         tmp=document.getElementById(hasil_cek);
                    }else{
                       hasil_cek=cek_element(keyword,tbody);    
                       tmp=document.getElementById(hasil_cek);
                       count++;
                    }
                    
                   
               }
         }
              
    }
      
       
   
}