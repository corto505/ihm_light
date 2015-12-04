<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/*****************************
	* Ecran minimaliste => affiche la meteo sur une semaine
	* Modifiée :  le 28/07/2014
	* Techno : PHP , No Angular
	* status : ok
	*/
	
	public function index(){
		//var_dump($this->config);die('xxx');
		// tableau equivalence pour icones
		$tabIcones = array(
			'01d' => 'B',
			'02d' => 'H',
			'03d' => 'N',
			'04d' => 'Y',
			'09d'=> 'R',
			'10d'=> 'Q',
			'11d'=> 'Z',
			'13d' => 'W',
			'50d' => 'M',
			'01n' => '2',
			'02n' => '4',
			'03n' => '5',
			'04n' => '%',
			'09n'=> '8',
			'10n'=> '7',
			'11n'=> '6',
			'13n' => '#',
			'50n' => '9');

		$this->load->model('Meteo_md');
		//$monTabJson = $this->Meteo_md->lireFileMeteo ('meteo_dump','json'); // pur test
		$monTabJson = $this->Meteo_md->meteo_api ('caen','json');
		//var_dump($monTabJson);die('xxx');
		//$monTabJson = json_decode($result,true);
		$meteo = $monTabJson['list'];
		//echo '<pre>';var_dump($meteo);die();
		//
		$data = array ('title' =>'Menu',
				'leType' => 'accueil',
				'erreur' => '',
				'ville' => $monTabJson['city']['name'],
				'dateDuJour' => date('l , d F Y'),
				'heure_cour' => date ('H') // pour filtrer le json de la meteo
				);
		$data['meteo'] = array();

		foreach ($meteo as $key => $value) {

			if (array_key_exists ($value['weather'][0]['icon'],$tabIcones)){
				$icone = $tabIcones[$value['weather'][0]['icon']];
			}else
			{
				$icone = ')'; // N/A
			}
			$temp = array( 'heure' =>  date ('H:i', $value['dt']),
					'icone'=> $icone,
					'temp' => $value['main']['temp'],
					'temp_min' => $value['main']['temp_min'],
					'temp_max' => $value['main']['temp_max'],
					'pressure' => $value['main']['pressure'],
					'laDate'  => date ('Y-m-d', $value['dt']),
					'description' => $value['weather'][0]['description']

				);
			$data['meteo'][date ('Y-m-d', $value['dt'])][]=$temp;
		}

		//echo '<pre>';var_dump($data['meteo']);die();
		$this->output->cache(30);
		$this->load->view('welcome_vw',$data);
	}

/**
*  Permet de tester le service
*  http://192.168.0.64:8090/ihm/index.php/welcome/test_ping
*/
public function test_ping(){
	echo(  json_encode('resultat ok'));

}

	/************************************
	 * Affiche le contenu du log modules/sed_cde
	 * @return [type] [description]
	 * techno : PHP , No Angular
	 * status : ok
	 */
	public function trace(){
		$this->load->helper('file');
		$data['contenu'] = read_file('./assets/json/modules_debug.log');

		$this->load->view('states_vw',$data);
	}

	/**
	*  Suppression du fichier de trace
	* avec un code pour la securite
	* techno : No UI, 
	*/
	public function delfile($code=''){

		if ($code=='master'){
			$path = $_SERVER['DOCUMENT_ROOT'].'assets/json/modules_debug.log';
			if (file_exists($path)){
				$result = shell_exec('sudo chmod 777 '.$path);
				unlink($path);	
			}
		}
		$this->trace();

	}

/**
* Ecran d'affichage info sur ecran 7"
* techno : PHP , choix non defenitif
*/
public function visu_vga_pi(){

	$data['ladate'] =Date('H:m:s');
	//var_dump($data);die();
	$this->load->view('vga_vw',$data);

}

//============  TEST CURL HORAIRE SAS ============

/**
 * Interroge le site des horaires et retoune un json
 * @param  [type] $jour [description]
 * @param  [type] $mois [description]
 * @return [type]       [description]
 */
	function sas($jour=null,$mois=null){
		if ($jour==null){
			$jour = date('j');
		}
		if ($mois==null){
			$mois = date('m');
		}
		$url='http://www.ouistreham-plaisance.com/web/horaires-des-sas.php/horaires-des-sas.php?jours='.$jour.'&mois='.$mois.'&valider=Rechercher';
	   	//debug($url,'end');
	        $ch = curl_init();
	        $timeout = 5;
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	        $html = curl_exec($ch);
	        curl_close($ch);

	        # Create a DOM parser object
	        $dom = new DOMDocument();
	        # Parse the HTML from Google.
	        # The @ before the method call suppresses any warnings that
	        # loadHTML might throw because of invalid HTML in the page.
	        @$dom->loadHTML($html);
	        $table = $dom->getElementsByTagName('tr');
	        $text='';
	        $i=0;
	        $tabResult = array();
	        foreach($table as $elemt){

	        	$td= $elemt->getElementsByTagName('td');
	        	foreach($td as $item){
	        		$text .= $i.' => '.$item->nodeValue.'</br>';
	        		$i+=1;

	        		if($i>3){
	        			switch ($i) {
	        			case '4':
	        				$tabResult['jour']=$item->nodeValue;
	        				break;
	        			case '5':
	        				$tabResult['journ']=$item->nodeValue;
	        				break;
	        			default:
	        				$tabResult['horaire'][]=trim($item->nodeValue);
	        				break;
	        			}
	        		}
	        		
	        	}
	        }
	        $myjson = json_encode($tabResult);
	      	//debug($myjson,'dev');
	      	return $myjson;
		}	

	function showhoraire(){
		$result = $this->sas();
		$data['heure'] = json_decode($result,TRUE);
		//debug($data,'dfqsd');
	// if (!log_sys("Creation sas"))
	 //		$data['heure']['jour']='erreur';

		$this->load->view('welcome_test_horaire_vw',$data);
	}	


/******************   TEST DIVERS *******************/

/*
*  Pas utilise - test Phil
*/
public function milight(){


 	echo '$$$$$$$$$';
	
	$server_ip   = '192.168.0.67';
	$server_port = 8899;
	$beat_period = 5;
	$message     = "\x39\x00\x55";
	print "Sending heartbeat to IP $server_ip, port $server_port\n";
	print "press Ctrl-C to stop\n";
	if ($socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) {
	 
	    $r= socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);
	    usleep(100);
	    $message     = "\x3B\x00\x55";
	   	    $r= socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);
		 //var_dump($socket);
	     usleep(100);
	         $message     = "\xBB\x00\x55";
	   	    $r= socket_sendto($socket, $message, strlen($message), 0, $server_ip, $server_port);

	} else {
	  print("can't create socket\n");
	}
}


/*************************************
*   AFFICHE La page pour google API speech
*  En attente !!
*/
public function speech() {
	$data['title']= 'Sunthèse vocale';
	$data['leType']= 'voix';
	$this->load->view('speech_vw',$data);
	//$this->meteo_api('caen','txt');
}

 
}
