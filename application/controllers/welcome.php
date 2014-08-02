<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	* Ecran minimaliste => affiche la meteo sur une semaine
	* Modifiée :  le 28/07/2014
	* status : ok
	*/
	public function index(){

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
	 * Affiche le contenu du log modules/sed_cde
	 * @return [type] [description]
	 */
	public function trace(){
		$this->load->helper('file');
		$data['contenu'] = read_file('./assets/json/modules_debug.log');

		$this->load->view('states_vw',$data);
	}

	/*
	*   AFFICHE La page pour google API speech
	*/
	public function speech() 
	{
		$data['title']= 'Sunthèse vocale';
		$data['leType']= 'voix';
		$this->load->view('speech_vw',$data);
		//$this->meteo_api('caen','txt');
	}

 
}