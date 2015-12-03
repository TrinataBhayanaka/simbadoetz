<?php


class home extends Controller {
	
	var $models = FALSE;
	var $view;

	
	function __construct()
	{
		global $basedomain;
		$this->loadmodule();
		$this->view = $this->setSmarty();
    $this->view->assign('basedomain',$basedomain);
    $userdata = $this->isUserOnline();
    $this->user = $userdata['default'];
    $browsertype = $this->checkBrowser();
    $this->view->assign('browsertype',$browsertype);

    }
	
	function loadmodule()
	{
    $this->loginHelper = $this->loadModel('loginHelper');
    $this->contentHelper = $this->loadModel('contentHelper');
	}
	function index(){

		global $CONFIG, $basedomain, $base_application;
// pr($base_application);
    $this->view->assign('baseApplication',$base_application);

    if($_GET['page']){
      if($_GET['page']=='1'){

        $data['page']=$this->loadView('module/daftar_aset_tetap/tanah');

      }elseif($_GET['page']=='2'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/peralatandanmesin');

      }elseif($_GET['page']=='3'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/gedungdanbangunan');

      }elseif($_GET['page']=='4'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/jalanirigasi');

      }elseif($_GET['page']=='5'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/asettetaplainnya');

      }elseif($_GET['page']=='6'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/konstruksi');

      }elseif($_GET['page']=='7'){
      
        $data['page']=$this->loadView('module/daftarasetlainnya');

      }elseif($_GET['page']=='8'){
        
        $data['page']=$this->loadView('module/daftarbarangnonaset');

      }elseif($_GET['page']=='9'){
        
        $data['page']=$this->loadView('module/rekapitulasibarangkeneraca');

      }elseif($_GET['page']=='10'){
        
        $data['page']=$this->loadView('module/kodesatker');

      }elseif($_GET['page']=='11'){
        
        $data['page']=$this->loadView('module/kodekelompok');

      }else{

       $data['page']=$this->loadView('dashboard');
      }

    }else{

      $data['page']=$this->loadView('dashboard');
    }

    $this->view->assign('page',$data['page']); 

    return $this->loadView('home');
  }
  function tesolah(){
      $url="http://simbada.pekalongankota.go.id/simbada/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&mode=&tab=&skpd_id=04.02&tglawalperolehan=&tglakhirperolehan=2014-12-31&tipe_file=3";
      $resultJson=file_get_contents($url);
      $jsonEncode=json_decode($resultJson);
      // $jsonEncode=$this->objectToArray($jsonEncode);
      // foreach ($jsonEncode as $key => $value) {
      //   $data[]=$this->objectToArray($value);
      // }

      // pr($data);
      pr($jsonEncode);
      exit;
  }
  function tes(){
    $data='<table border="1" width="100%">
            <thead>
              <tr>
                <th>Kode Sektor</th>
                <th>Kode Satker</th>
                <th>Kode</th>
                <th>Nama Satker</th>
              </tr>
            </thead>
            <tbody>

            <tbody>
          </table>
    ';

    $data=htmlspecialchars($data);
    pr($data);
    exit;
  }
  function mengolahData(){
    
    global $CONFIG, $basedomain, $base_application;
// pr($base_application);
    $this->view->assign('baseApplication',$base_application);
    if($_GET['page']=='1'){

      return $this->loadView('module/mengolahData');

    }elseif($_GET['page']=='2'){
      $url="http://simbada.pekalongankota.go.id/simbada/report/template/PEROLEHAN/report_perolehanaset_cetak_aset_tetap_tanah.php?menuID=&mode=&tab=&skpd_id=04.02.01&tglawalperolehan=&tglakhirperolehan=2014-12-31&tipe_file=3";
      $resultJsonEncode=file_get_contents($url);

      $resultJsonDecode=json_decode($resultJsonEncode);
      $result=(array)$resultJsonDecode;
      $dataJsonDecode=$result['04.02.01.01']->Tanah;
      // pr($result['04.02.01.01']->Tanah);exit;
      $this->view->assign('JsonEncode',$resultJsonEncode); 
      $this->view->assign('JsonDecode',$resultJsonDecode); 
      $this->view->assign('DataJsonDecode',$dataJsonDecode); 
      // pr($resultJsonDecode);exit;
      return $this->loadView('module/mengolahDataDaftarAset');

    }elseif($_GET['page']=='3'){

      $url="http://simbada.pekalongankota.go.id/simbada/services/home/satker/?term=04.02";
      $resultJsonEncode=file_get_contents($url);

      $resultJsonDecode=json_decode($resultJsonEncode);

      $this->view->assign('JsonEncode',$resultJsonEncode); 
      $this->view->assign('JsonDecode',$resultJsonDecode); 
      return $this->loadView('module/mengolahDataKodeSatker');

    }elseif($_GET['page']=='4'){
      $url="http://simbada.pekalongankota.go.id/simbada/services/home/kelompok/?term=02.02";
      $resultJsonEncode=file_get_contents($url);

      $resultJsonDecode=json_decode($resultJsonEncode);


      $this->view->assign('JsonEncode',$resultJsonEncode); 
      $this->view->assign('JsonDecode',$resultJsonDecode); 

      return $this->loadView('module/mengolahDataKodeKelompok');

    }else{

      return $this->loadView('module/mengolahData');
    }  
  }
  function satker(){

  $term = filter_var($_GET['term'],FILTER_SANITIZE_STRING);
  $sess = "";
  $free = 0;
    $data=$this->contentHelper->mSatker($term,$sess,$free);

     echo json_encode($data);
     exit;
  }
  function kelompok(){

    $term = filter_var($_GET['term'],FILTER_SANITIZE_STRING);

    $data=$this->contentHelper->mKelompok($term);

     echo json_encode($data);
     exit;
  }
     function objectToArray( $object )
    {
        if( !is_object( $object ) && !is_array( $object ) )
        {
            return $object;
        }
        if( is_object( $object ) )
        {
            $object = get_object_vars( $object );
        }

        return $object;
    }
  function ajaxPage(){
    global $CONFIG, $basedomain, $base_application;
// pr($base_application);
    $this->view->assign('baseApplication',$base_application);
    if($_POST['page']){
      if($_POST['page']=='1'){

        $data['page']=$this->loadView('module/daftar_aset_tetap/tanah');

      }elseif($_POST['page']=='2'){
        
        $data['page']=$this->loadView('module/daftar_aset_tetap/peralatandanmesin');

      }else{

       $data['page']=$this->loadView('dashboard');
      }

    }else{

      $data['page']=$this->loadView('dashboard');
    }

    // $this->view->assign('page',$data['page']); 
    
    if ($data['page']){
            print json_encode(array('status'=>true, 'data'=>$data['page']));
        }else{
            print json_encode(array('status'=>false));
        }
        
        exit;
    
  }
}

?>
