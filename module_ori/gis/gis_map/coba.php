<script type="text/javascript">
                              var map;
                              $(document).ready(function(){
                                   map = new GMaps({
                                   div: '#masuk',
                                   lat: 4.695135,
                                   lng: 96.749399,
                                   zoom:7,
                                   zoomControl : true,
                                   zoomControlOpt: {
                                        style : 'SMALL',
                                        position: 'TOP_LEFT'
                                   },
                                   panControl : false,
                                   streetViewControl : false,
                                   mapTypeControl: false,
                                   overviewMapControl: false
                                   });
                              });
                              </script>
                         <div id="bottomright">
                              <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
                              <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/gmaps.js"></script>
                              <div id="tes" style="border:1px solid #004933; width: 640px; height: 350px">
                                        <div id="masuk" style="width: 400px;height:400px">
                                             asdas
                                        </div>
                                   </div>
                                   
                         </div>