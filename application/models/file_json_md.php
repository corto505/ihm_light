<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_json_md extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}

	
	public function p_lireFileJson($nom){ //ok

		$pathFile = './assets/json/'.$nom.'.json';
		
		if (file_exists($pathFile)){
			
			$contenu = read_file ($pathFile);
			return $contenu;
		}else{
		
			return false;
		}
	}
}

?>