<?php
/*
*	The MIT License (MIT)

*	Copyright (c) <2013 - 2014> <Filipe Marques - eagle.software3@gmail.com>

*	Permission is hereby granted, free of charge, to any person obtaining a copy
*	of this software and associated documentation files (the "Software"), to deal
*	in the Software without restriction, including without limitation the rights
*	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*	copies of the Software, and to permit persons to whom the Software is
*	furnished to do so, subject to the following conditions:

*	The above copyright notice and this permission notice shall be included in
*	all copies or substantial portions of the Software.

*	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
*	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
*	THE SOFTWARE.
*
*/


class Process{
	
	public function translate_country($country){
    	switch ($country) {
        	case 'pt':
        	    echo LABEL_TRANSLATE_COUNTRY1;
        	    break;
        	case 'es':
        	    echo LABEL_TRANSLATE_COUNTRY2;
        	    break;
        	case 'fr':
            	echo LABEL_TRANSLATE_COUNTRY3;
            	break;
        	case 'uk':
            	echo LABEL_TRANSLATE_COUNTRY4;
            	break;
        	case 'us':
            	echo LABEL_TRANSLATE_COUNTRY5;
            	break;
        	case 'br':
            	echo LABEL_TRANSLATE_COUNTRY6;
            	break;
   		}
	}
	
	public function idiom_geoip(){
		$country = geoip_country_code_by_name($_SERVER['REMOTE_ADDR']);
		switch ($country) {
			case 'pt':
				require_once ("lang/pt.php");
				break;
			case 'es':
				require_once ("lang/es.php");
				break;
			case 'fr':
				require_once ("lang/fr.php");
				break;
			case 'uk':
				require_once ("lang/uk.php");
				break;
			case 'us':
				require_once ("lang/us.php");
				break;
			case 'br':
				require_once ("lang/br.php");
				break;
			default:
				require_once ("lang/uk.php");
		}
	}
	
	public function idiom_without_session($id){
		switch ($id) {
			case 'pt':
				require_once ("lang/pt.php");
				break;
			case 'es':
				require_once ("lang/es.php");
				break;
			case 'fr':
				require_once ("lang/fr.php");
				break;
			case 'uk':
				require_once ("lang/uk.php");
				break;
			case 'us':
				require_once ("lang/us.php");
				break;
			case 'br':
				require_once ("lang/br.php");
				break;
		}
	}
	
	public function check_session_idiom(){
		if (isset($_SESSION['pais'])){
			$pais = $_SESSION['pais'];
			switch ($pais) {
				case 'pt':
					require_once ("lang/pt.php");
					break;
				case 'es':
					require_once ("lang/es.php");
					break;
				case 'fr':
					require_once ("lang/fr.php");
					break;
				case 'uk':
					require_once ("lang/uk.php");
					break;
				case 'us':
					require_once ("lang/us.php");
					break;
				case 'br':
					require_once ("lang/br.php");
					break;
			}
		}
	}
	
	public function ip_adress(){
		$http_client_ip = $_SERVER['HTTP_CLIENT_IP'];
		$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote_adress = $_SERVER['REMOTE_ADDR'];
		
		if (!empty($http_client_ip)){
			$ip = $http_client_ip;
		} elseif (!empty($http_x_forwarded_for)){
			$ip = $http_x_forwarded_for;
		}else{
			$ip = $remote_adress;
		}
		return $ip;
	}
	
	
	public function venda($termo) {
    	if ($termo === 'N') {
        	echo (LABEL_VENDA1);
    	} elseif ($termo === 'S') {
        	echo (LABEL_VENDA2);
    	}
	}
	
	public function resize_image($filename) {
		$newwidth = 300;
		$newheight = 200;
		list($width, $height) = getimagesize($filename);
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefrompng($filename);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		imagepng($thumb);
    	imagedestroy($thumb);
	}
	
	public function spam_out($emai) {
    	$emai = filter_var($emai, FILTER_SANITIZE_EMAIL);
    	if (filter_var($emai, FILTER_VALIDATE_EMAIL)) {
        	return TRUE;
    	} else {
        	return FALSE;
    	}
	}
	
	public function search($sear) {
		switch ($sear) {
		    case '':
		        echo LABEL_;
		        break;
		    }
	}
}

?>

