<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($nom)
	{
		return base_url() . 'assets/css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($nom)
	{
		return base_url() . 'assets/js/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	function img_url($nom)
	{
		return base_url() . 'assets/images/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	function img($nom, $alt = '')
	{
		return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
	}
}

// :::::::::   GET JSON WITH CURL :::::
if(!function_exists('curl_json'))
{
	function curl_json($url,$sortie='json'){

				// set HTTP header
		if($sortie=='json'){
			$headers = array(
		    'Content-Type: application/json',
			);
		}

		$ch = curl_init();
		//echo '<br> curl : URL = '.$url;
		// Set the url, number of GET vars, GET data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		// Execute request
		$result = curl_exec($ch);
		//echo '<pre/>';var_dump($result);//die();
		// Close connection
		curl_close($ch);

		switch ($sortie) {
			case 'json':
				return json_decode($result, true);
				break;

			default:
				return $result;
				break;
		}
			
	}
}

// :::::::::   Parametres :::::
if(!function_exists('prefrences'))
{
	function prefrences($choix){

		switch ($choix) {
			case 'domoticz':
				return "http://192.168.0.66:8080/";
				break;

			case 'htc_sms':
				return "http://192.168.0.60:9090/";
				break;

			case 'phone':
				return "0689816473";
				break;

			default:
				return "!**! erreur de paramètres";
				break;
		}
	}
}


?>