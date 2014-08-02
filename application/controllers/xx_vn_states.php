<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vn_states extends CI_Controller {

	/***
     *  Statistiques RBI - Affiche le Tdb des states
     ***/
	public function index(){
     	$data['title']= 'Statistiques';
		$data['leType']= '';
		$this->load->view('states_vw',$data);
     }


	public function commande($commande){
		    
	switch ($commande) {
      case 'heure':
        $myScript = 'vnstat -i wlan0 -h';
        break;
      case 'jour':
        $myScript = 'vnstat -i wlan0 -d';
        break;
      case 'mois':
        $myScript = 'vnstat -i wlan0 -m';
        break;
      case 'semaine':
        $myScript = 'vnstat -i wlan0 -w';
        break;
      case 'short':
        $myScript = 'vnstat -i wlan0 -s';
        break;
      case 'home':
        $myScript = '';
        break;
      case 'cron':
        $myScript = 'crontab -l';
        break;
      case 'gpio':
        $myScript = 'gpio readall';
        break;
      case 'dd':
        $myScript = 'df -h';
        break;
      default:
       $myScript = 'xx';
        break;
    }
	 passthru($myScript,$response);
	echo ($response);
   }
	
}

?>