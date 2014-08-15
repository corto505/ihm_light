<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domo_md extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

/**
	*  Recupere tous les modules de DOMMOTICZ dans un fichier JSON
	*  Permet de lire les modules sans interroger Domoticz
	*/
	public function domo_dump($sortie='json'){ //OK
		
		$data= array();
		$this->load->helper('file');
		$this->load->helper('url');

		$content = curl_json( prefrences("domoticz").'json.htm?type=devices&filter=switchlight&used=true&order=Name','json');
		//var_dump($content);
		//
		switch ($sortie) {
			case 'json':
				return $content;
				break;
			

			case 'file':
				if (!write_file('./assets/json/domoticz_dump.json',$content))
				{
					$data['erreur']="Erreur ecriture file dump.json";
					$this->load->view('error_vw',$data);
				}else{
					redirect(base_url());
				}	
				break;

			default:
				return $content;
				break;
		}
		
    }


/*
	*  Recupere les infoDomoticz via requete HTTP
	*  Angular - 
	*/
	public function lireScenes($sortie='json'){		
		
		$url=prefrences("domoticz").'json.htm?type=scenes';
		//var_dump($url);
		$data = curl_json($url,$sortie); //var_dump($data);die();

		switch ($sortie) {
			case 'text':
				echo '<pre>'.$data.'</pre>';
				break;

			case 'debug':
				var_dump($data);die();
				break;
			default:
				return $data;
				break;
		}
     }



	/**
	* !!**!! ATTENTION ne pas mettre d'echo, sinon pollue le JSON  !!**!!
	*/
	public function lireFileDomo($sortie='json'){

	
			$this->load->model('File_json_md');
			$data = $this->File_json_md->p_lireFileJson ('domoticz_dump');
	
		switch ($sortie) {
			case 'text':
				return $data;
				break;

			case 'debug':
				echo '<pre>';var_dump($data);die();
				break;

			default:
				 $obj_json=json_decode($data,true);
				// echo '<pre/>';var_dump($obj_json);die();
				 return $obj_json;
				break;
		}
	}


/**
 *  Defini un tableau de modules abvec les index de DOMOTICZ
 */
public function tableauModules(){
	$tabModules=array(
		'radiateur_chambre' => 15,
		'radiateur_sdb'	=> 35,
		'radiateur_bureau' => 12,
		'radiateur_couloir'  => 17,
		'lampe_bureau_3' => 11,
		'lampe_bureau_4'  => 9,
		'lampe_jukebox'	=> 30,
		'spot_salle'	=> 31,
		'lampe_marine_salle' => 33,
		'veilleuse_chambre'  => 34,
		'radio_cuisine'  => 40,
		'barre_cuisine' => 43,
		'lampe_chemine_salle'  => 44,
		'allumer' => 'On',
		'allume'  =>  'On',
		'ouvre'  => 'On',
		'demarre' => 'On',
		'eteind'  => 'Off',
		'eteindre' => 'Off',
		'arrete' => 'Off',
		'arreter' => 'Off',
		'ferme'  => 'Off'
		);

	return $tabModules;

}


}

?>