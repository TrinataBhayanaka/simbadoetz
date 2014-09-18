<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include "convert_latitude_longitude.php";

$longitude=DMStoDEC(5, 31,0);
$latitude=DMStoDEC(95, 32, 0);

echo "Longitude: $longitude <br/>Latitude: $latitude";
?>
