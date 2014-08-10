<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modules extends CI_Controller {

	
	/***********************
	*  Par defaut affiche les lumieres
	*  status : ok
	*/
	public function index(){ //ok
		$this->liste_modules('Lighting');
     }
	
    /***************************
	*  Les des # thermomètres
	*  status : ok
	*/
	public function thermo(){		
		$this->liste_modules('Temp');
     }

 /********************************
	*  Les des # Faux formulaire de recherche
	*  permet d 'exucuter des commande'
	*  Om peut envoyer les donnée par  
	*  POST = formulaie via internet 
	*  GET = par reroutage (forwading) de sms via HTC : index.php/modules/form_chercher?la_recherche=allumer%20radiateur%20chambre
	*  status : ok
	*/
	public function form_chercher(){
		$val = $this->input->get_post('la_recherche',TRUE);
		//var_dump($val);die();
		$data = array('visu'=>'hidden');

		if ($val){
			$tabCde = explode(" ",$val); // decoupe l' URL
			$ordre =  (isset($tabCde[0])) ? $tabCde[0] : 'erreur' ;
			$module = (isset($tabCde[1])) ? $tabCde[1] : 'erreur' ;
			$lieu =(isset($tabCde[2])) ? $tabCde[2] : 'erreur' ;

			if (($ordre!='erreur')&&($module!='erreur')&&($lieu!='erreur')){
				//On passe tous les chriteres en minuscule
				$key = strtolower($module."_".$lieu);
				$ordre =strtolower($ordre);

				// On charge le tableau des commandes et on verifie que celles envoyées existes
				$this->load->model('Domo_md');
				$tableauModules = $this->Domo_md->tableauModules();
				$commande = (array_key_exists($ordre, $tableauModules)) ? $tableauModules[$ordre] : 'erreur';


				if ((array_key_exists($key, $tableauModules)) and ($commande!='erreur')){
					$data['laCde']='Votre demande a ete envoyee';
					$data['visu'] = 'alert-success';
					$status = $this->send_cde($tableauModules[$key],$commande);
					//@@TODO : tester un retourn si possible
					if($status =='OK'){
						$this->send_sms($data['laCde']); //die('sms');
					}else
					{
						//var_dump($status);die();
					}

				}else{
					$data['laCde']='Je n\'ai pas trouvé de résultat';
					$data['visu'] = 'alert-warning';
				}

			}else{
				$data['laCde']="Commande incorrecte";
				$data['visu'] = 'alert-danger';
			}

		}else{
			$data['laCde']="";
		}	

		$this->load->view('form_recherche_vw',$data);;
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
	public function send_cde($id,$cde,$who=''){ 
	
		$this->load->helper('file');
		write_file('./assets/json/modules_debug.log', date('Y-m-d H:i').' : ('.$who.') json.htm?type=command&param=switchlight&idx='.$id.'&switchcmd='.$cde."\r\n", 'a');
		
		$url=prefrences("domoticz").'json.htm?type=command&param=switchlight&idx='.$id.'&switchcmd='.$cde.'&level=0';
		//echo '<br> modules : URL = '.$url;
		$content = curl_json($url);
		//var_dump($content); die();// { ["status"]=> string(3) "ERR" }  ou  { ["status"]=> string(2) "OK" ["title"]=> string(11) "SwitchLight" }
		return $content['status'];
		//@@TODO  - tester le retour content et eventuellement s'en servire pour valider result
		///redirect(base_url());

		
        }

       /**
        * Permet d'envoyer des sms par gateway SMS sur HTC
        * @param  [type] $message [description]
        * @param  string $tel     [description]
        * @return [type]          [description]
        */
      public function send_sms($message,$tel=''){

      	if ($tel=='')
      		$tel = prefrences("phone");

      	$this->load->helper('file');
		write_file('./assets/json/modules_debug.log', date('Y-m-d H:i').' : '.$message."\r\n", 'a');

		$message = urlencode($message);
		//str_replace(' ','%20',$message);
	//	echo($message);
	//	@@TODO enlever les commentaires
		$url=prefrences("htc_sms").'sendsms?phone='.$tel.'&text='.$message.'&password=tedjyx33';
		
		$content = curl_json($url);
		
		//return $content['status'];
		//var_dump($content);die('content_sms');
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

		date_default_timezone_set("Europe/Paris");
		$data['ladate']= date('D, d F Y H:i');
		$data['leType']= $type;
		
		if ($type=='Temp'){
			$this->load->view('temp_vw',$data);//
		}else{
			$this->load->view('modules_vw',$data);//
		}

	}


	function sms_predefini($code,$return='ihm'){

		$mess = '';
		switch  ($code){
			case 'test':
				$mess = 'sms de test rpb1';
			break;

			default:

			break;
		}

		if ($mess!=''){
			$this->send_sms($mess);	
		}  

		if ($return=='txt'){
			echo 'sms envoyé';
		} else{
			$this->form_chercher();
		}   
	}
}