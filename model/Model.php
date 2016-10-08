<?php
require_once "model/Template.php";

function money_f($p){
  $remainder = intval($p / 1000);
  if( $remainder == 0 ){
    return "IDR $p";
  }
  else{
		$p = intval($p % 1000).'';
		while( strlen($p) < 3 )
			$p = "0".$p;
		return money_f( $remainder ).".".$p;

	}
}

function date_catalog_f($raw){
  $phpdate = strtotime($raw);
  $mysqldate1 = date('l, d F Y',$phpdate);
  $mysqldate2 = date('H.i',$phpdate);
  return $mysqldate1.", at ".$mysqldate2;
}

function date_shop_f($raw){
  $phpdate = strtotime($raw);
  $mysqldate1 = date('l, d F Y',$phpdate);
  $mysqldate2 = date('H.i',$phpdate);
  return "<b>".$mysqldate1."</b><BR>at ".$mysqldate2;
}


function generate_random_string($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

function get_image_store_location($fn){
	$imageFileType = pathinfo(basename($fn),PATHINFO_EXTENSION);
	$target_file = "";
	do {
		$target_file = IMAGE_UPLOAD_DIR . generate_random_string().".$imageFileType";
	}
	while (file_exists($target_file));

	return $target_file;
}

class Model {
	function __construct(){
		$view = new Template();
		$this->view = $view;
	}

	function init_db(){
		if( isset($this->db) )
			return;

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno ){
			throw new Exception("Cannot connect to database");
		}
		$this->db = $mysqli;

	}
}
?>
