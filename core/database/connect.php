<?php
	function connect() {
		$db = mysql_connect("campub.co.uk.mysql", "campub_co_uk", "CLbeFYYz");
		if($db->connect_errno > 0){
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		mysql_select_db("campub_co_uk",$db) or die('ahhhhhhhhhhhhhhh, something went wrong, oops.');
		return $db;
	}