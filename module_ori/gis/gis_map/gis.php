<?php
include "../../config/config.php";
?>

<html>
    <?php
    include "$path/header.php";
    ?>
    
    <style>
        #errmsg { color:green; }
    </style>
	<style>
        #errmsg2 { color:green; }
	</style>
	<style>
        #errmsg3 { color:green; }
	</style>
    
    <script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#lda_ia").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#lda_nk").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<script type="text/javascript">
        $(document).ready(function(){

            //called when key is pressed in textbox
                $("#lda_tp").keypress(function (e)  
                { 
                //if the letter is not digit then display error and don't type anything
                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                {
                        //display error message
                        $("#errmsg3").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                    return false;
            }	
                });
        });
    </script>
	<body>
	<div id="content">
	<?php
	
        include "$path/title.php";
        include "$path/menu.php";
        ?>
        
            <div id="tengah1">
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            GIS
                            
                        </div>
                          <script type="text/javascript">
                              var map;
                              $(document).ready(function(){
                                   map = new GMaps({
                                   mapType:'Hybrid',
                                   div: '#masuk',
                                   lat: 4.095135,
                                   lng: 96.749399,
                                   zoom:7
                                   });
                          
                                   map.addMarkers([
      {lat:4.295135, lng:96.749399, title: 'Nama Aset untuk aset', infoWindow: {
                                                  content: '<p>HTML Content</p>'
                                             }},
      {lat:4.395135,lng:96.749399, title: 'Nama Aset untuk aset2', infoWindow: {
                                                  content: '<p>HTML Content2</p>'
                                             }},
      {lat:4.195135, lng:96.749399, title: 'Nama Aset untuk aset2', infoWindow: {
                                                  content: '<p>HTML Content2</p>'
                                             }}
    ]
                                             );
                                       
                                   
       /*                             map.loadFromKML({
        url: 'http://123.108.97.228/example.kml',
        suppressInfoWindows: true,
        events: {
          click: function(point){
            infoWindow.setContent(point.featureData.infoWindowHtml);
            infoWindow.setPosition(point.latLng);
            infoWindow.open(map.map);
          }
        }
      });*/
                              });
                              </script>
                         <div id="bottomright">
                              <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
                              <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/gmaps.js"></script>
                              
                                        <div id="masuk" style="border:1px solid #004933;width: 1000px;height:500px">
                                             asdas
                                        </div>
                              
                                   
                         </div>
                  
                    </div>
                </div>
            </div>
        </div>
        
        <?php 
        include "$path/footer.php";
        ?>
     </body>
</html>	
