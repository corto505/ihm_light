<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meteo_md extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}


	/**
	 *  Interogation API OpenMeteo
	 *  status : ok
	 **/
	public function meteo_api($ville='caen',$sortie='txt')
	{
		$data = array();

		$url = 'api.openweathermap.org/data/2.5/forecast/city?q='.$ville.',fr&units=metric&mode=json'; // ou switchcmd=Off
	/*	$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);

		$c = curl_exec($ch);
		curl_close($ch); 
		$var_json = json_decode($c, true);*/
		$var_json = curl_json($url,'json');
		//var_dump($var_json);die('rrrrrr');
		//*********  Aiguillage des sorties  ***********
		switch ($sortie) {
			case 'debug':
				echo '<pre>';
				var_dump($c);
				var_dump($var_json);
				die();
			break;
			
			case 'json': // On decoupe le fichier pour garder le meilleur
			//var_dump($var_json);
				return $var_json;

			break;

			case 'file':

				if (!write_file('./assets/json/meteo_dump.json',$c))
				{
					$data['erreur']="Erreur ecriture file meteo_dump.json";
					$this->load->view('error_vw',$data);
				}else{
					redirect(base_url()+'/index.php/modules/meteo');
				}
			break;

			default:
				$data['erreur']="Erreur ecriture file dump.json";
				$this->load->view('error_vw',$data);
			break;
		}
		
	}


/**
* !!**!! ATTENTION ne pas mettre d'echo, sinon pollue le JSON  !!**!!
* permet de lire le fichier meteo mis en cache => pour demo
* status : ok
*/
	public function lireFileMeteo($file,$sortie='json'){

		$this->load->model('File_json_md');
		$data = $this->File_json_md->p_lireFileJson ($file);
		
		//*********  Aiguillage des sorties  ***********
		switch ($sortie) {
			case 'text':
				return $data;
				break;

			case 'debug':
				//echo '<pre>';var_dump($data);die();
				break;

			default:
				 $obj_json=json_decode($data,true);
				// echo '<pre/>';var_dump($obj_json);die();
				 return $obj_json;
				break;
		}
	}
}
?>