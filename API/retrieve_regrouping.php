<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
class RETRIEVE_REGROUPING extends RETRIEVE{
      public function getStatusRegrouping($par=NULL){
               if ($par!="")
                         $par="where KelompokAset='$par'";
               $query="select * from regrouping $par";
			   // echo "<pre>";
			   // echo $query; 
               $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   // echo "<pre>";
			   // print_r($dataArr);
               return $dataArr;
                 
          }

  function getMergeData($event)
  {

    $sql = array(
            'table'=>"tmp_merger",
            'field'=>"*",
            'condition'=>"event = '{$event}' ORDER BY id DESC ",
            'limit'=>1
            );

    $aset = $this->lazyQuery($sql,$debug);

    if ($aset){

      $kodeSatkerTmp = unserialize($aset[0]['data']);
      $kodeSatker = $kodeSatkerTmp[0]['kodeSatker'];
      // pr($kodeSatker);
      $sql = array(
              'table'=>"satker",
              'field'=>"NamaSatker",
              'condition'=>"kode = '{$aset[0]['event']}' ",
              'limit'=>1
              );

      $res = $this->lazyQuery($sql,$debug);

      $sql = array(
              'table'=>"satker",
              'field'=>"NamaSatker",
              'condition'=>"kode = '{$kodeSatker}' ",
              'limit'=>1
              );

      $res1 = $this->lazyQuery($sql,$debug);

      $data[0]['id'] = $aset[0]['id'];
      $data[0]['old_kodeSatker'] = $aset[0]['event'];
      $data[0]['old_NamaSatker'] = $res[0]['NamaSatker'];
      $data[0]['kodeSatker'] = $kodeSatker;
      $data[0]['NamaSatker'] = $res1[0]['NamaSatker'];
      $data[0]['Aset'] = $aset[0]['Aset'];
      return $data;
    }
    return false;
    
    

  }

  function getMergeDataPreview()
  {

    $sql = array(
            'table'=>"tmp_merger",
            'field'=>"*",
            'condition'=>"n_status IN (1,2) ",
            );

    $aset = $this->lazyQuery($sql,$debug);

    if ($aset){

      foreach ($aset as $key => $value) {
          $kodeSatkerTmp = unserialize($value['data']);
          $kodeSatker = $kodeSatkerTmp[0]['kodeSatker'];
          // pr($kodeSatker);
          $sql = array(
                  'table'=>"satker",
                  'field'=>"NamaSatker",
                  'condition'=>"kode = '{$value['event']}' ",
                  'limit'=>1
                  );

          $res = $this->lazyQuery($sql,$debug);

          $sql = array(
                  'table'=>"satker",
                  'field'=>"NamaSatker",
                  'condition'=>"kode = '{$kodeSatker}' ",
                  'limit'=>1
                  );

          $res1 = $this->lazyQuery($sql,$debug);

          $data[$key]['id'] = $value['id'];
          $data[$key]['old_kodeSatker'] = $value['event'];
          $data[$key]['old_NamaSatker'] = $res[0]['NamaSatker'];
          $data[$key]['kodeSatker'] = $kodeSatker;
          $data[$key]['NamaSatker'] = $res1[0]['NamaSatker'];
          $data[$key]['n_status'] = $value['n_status'];
      }
      
      return $data;
    }
    return false;
    
    

  }
}
?>
