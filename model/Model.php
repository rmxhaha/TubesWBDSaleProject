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
  $mysqldate2 = date('H i',$phpdate);
  return $mysqldate1.", at ".$mysqldate2;
}

function date_shop_f($raw){
  $phpdate = strtotime($raw);
  $mysqldate1 = date('l, d F Y',$phpdate);
  $mysqldate2 = date('H i',$phpdate);
  return "<b>".$mysqldate1."</b><BR>at ".$mysqldate2;
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
