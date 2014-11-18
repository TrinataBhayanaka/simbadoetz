<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
class RETRIEVE_PENYUSUTAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
      
          public function getStatusPenyusutan($par=NULL){
               if ($par!="")
                         $par="where KelompokAset='$par'";
               $query="select * from penyusutan_tahun_pertama $par";
               $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
               return $dataArr;
                 
          }
}
?>
