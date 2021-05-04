<?php

include_once '../../db.conf';

class DBCon  {
	private $link;
	private $dbsettings;
	function __construct() {
		
		// $config = new Config;
		// $this->dbsettings = $config->getDBSettings();
	}

	public function getCon(){
		$host = server;
		$user = user;
		$pw = pass;
		$db = db;
		
		// $this->link = new mysqli ($host,$user,$pw,$db);
		$this->link =  new mysqli($host,$user,$pw,$db);
		
		if ($this->link->connect_error) {
			echo ("DB connection error: ".$this->link->connect_error);
			exit;
		}

	return $this->link;		
	}
}


?>