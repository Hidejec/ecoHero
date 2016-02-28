<?php

class Database{

	protected static $con;
	protected function getConnection(){
		$con = mysql_connect("localhost", "root" , "");
		if(!$con){
			die("Eror");
		}
		mysql_select_db("ecotransit",$con);
		return $con;

	}

}