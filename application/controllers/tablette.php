<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tablette extends CI_Controller {

	public function index(){

		$this->load->model('File_json_md');
		$data = $this->File_json_md->p_lireFileJson ('les_boutons');
		$montab = json_decode($data,true);
		//var_dump($montab['menu']);die();
		$data = array ('title' =>'Menu tablette',
				'leType' => 'accueil',
				'erreur' => '',
				'tdb' => array(),
				'menu'=> array()
				);

		$data['tdb'] = $montab['tdb'];
		$data['menu'] = $montab['menu'];


		$this->load->view('tablette_vw',$data);
	}
}