<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/*****************************
	* Ecran minimaliste => affiche la meteo sur une semaine
	* Modifiée :  le 28/07/2014
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



/******************   TEST DIVERS *******************/
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
*/
public function speech() {
	$data['title']= 'Sunthèse vocale';
	$data['leType']= 'voix';
	$this->load->view('speech_vw',$data);
	//$this->meteo_api('caen','txt');
}

 
}
