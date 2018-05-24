<?php
if(!function_exists('salt')){
 	function salt($length) {
	     $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789;:?.>,<!@#$%^&*()-_=+|';
	     $randStringLen = $length;

	     $randString = "";
	     for ($i = 0; $i < $randStringLen; $i++) {
	         $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
	     }

	     return $randString;
	}
}

if(!function_exists('generate_token')){
 	function generate_token($length) {
	     $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	     $randStringLen = $length;

	     $randString = "";
	     for ($i = 0; $i < $randStringLen; $i++) {
	         $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
	     }

	     return $randString;
	}
}

if (!function_exists('shaPassword')) {
	function shaPassword($field = "", $salt = "")  {
		if($field) {
			return hash('sha256', $field.$salt);
		}
	}
}

if (!function_exists('plushrs')) {
	function plushrs($dt, $hrs){
		$pure = strtotime($dt);
		$plus = ($pure + 60*60*$hrs);
		$newPure = date('Y-m-d H:i:s', $plus);
		return $newPure;
	}
}

if (!function_exists('ngn')) {
	function ngn($amt = ''){
        if ($amt == '') $amt = '0';
           return '₦'.number_format($amt, 2, '.', ',');
	}
}

if (!function_exists('get_now')) {
	function get_now(){
		return date("Y-m-d H:i:s");
	}
}

function get_percentage($total, $number){
 	if ( $total > 0 ) {
 		return round($number / ($total / 100),2);
  	} else {
    	return 0;
  	}
}

function ago($time){
	$time = strtotime($time);
	$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths = array("60","60","24","7","4.35","12","10");

	$now = time();

	   $difference     = $now - $time;
	   $tense         = "ago";

	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	   $difference /= $lengths[$j];
	}

	$difference = round($difference);

	if($difference != 1) {
	   $periods[$j].= "s";
	}

	return "$difference $periods[$j] ago ";
}


function cleanit($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function urlify($string)
{
    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
}


?>
