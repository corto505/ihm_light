<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends CI_Controller {

	
	/*
	*  Par defaut affiche les lumieres
	*  status : ok
	*/
	public function index(){ //ok
		$this->liste_modules('Lighting');
     }
	
    /*
	*  Les des # thermomètres
	*  status : ok
	*/
	public function thermo(){		
		$this->liste_modules('Temp');
     }

 
    /*
	*  Envoi une commande à domoticz
	*  Avec creation d'un log
	*  status : OK
	*   - /json.htm?type=command&param=switchscene&idx=11&switchcmd=On   //Turn a scene / group on or off
	*   - /json.htm?type=devices&filter=all&used=true&order=Name
	*   
	*   - /json.htm?type=status-temp  // =>json temperature
	*   - /json.htm?type=scenes  	-> scenes et groups
	*   - /json.htm?type=hardware	-> virtual device
	*
	*   - /json.htm?type=command&param=getuservariables   => liste ttes les variables
	*   - /json.htm?type=command&param=getuservariable&idx=idx    => liste une variable
	*   - (!!) /json.htm?type=command&param=updateuservariable&idx=idx&vname=uservariablename&vtype=uservariabletype
&vvalue=uservariablevalue   =>  met à jour une variable
	*  
	*  http://$DOMO_IP:$DOMO_PORT/backupdatabase.php 
	*/
	public function send_cde($id,$cde,$who='xx'){ 
	
		$this->load->helper('file');
		write_file('./assets/json/modules_debug.log', date('Y-m-d H:i').'('.$who.') : json.htm?type=command&param=switchlight&idx='.$id.'&switchcmd='.$cde."\r\n", 'a');
		
		$url=prefrences("domoticz").'json.htm?type=command&param=switchlight&idx='.$id.'&switchcmd='.$cde.'&level=0';
		//echo '<br> modules : URL = '.$url;
		$content = curl_json($url);
		///redirect(base_url());
        }



/**
 *  Affiche les modules par pieces 
 *  url : index.php/modules/liste_modules/json
 *  modifiée : 28/07/2014
 *  status : ok
 **/
	public function liste_modules($type){

		$data = array();

		$this->load->model('Domo_md');
		$monTabJson = $this->Domo_md->domo_dump ('json');
		//$monTabJson = $this->Domo_md->lireFileDomo ('json');
		$data['lesModules']  = $monTabJson['result'];
		//echo '<pre/>';var_dump($data['lesModules']);die();

		$data['title']= 'Modules Domoticz';
		$data['leType']= $type;
		
		if ($type=='Temp'){
			$this->load->view('temp_vw',$data);//
		}else{
			$this->load->view('modules_vw',$data);//
		}

	}        
}