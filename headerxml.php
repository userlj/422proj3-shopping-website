<?php
//http://www.mightywebdeveloper.com/coding/mysql-to-xml-php/
	
	//database configuration
	$config['mysql_host'] = "bigyellowcat.cs.binghamton.edu";
	$config['mysql_user'] = "meng";
	$config['mysql_pass'] = "meng7842";
	$config['db_name']    = "meng";
	$config['table_name'] = "products";

	//connect to host
	$conn=mysql_connect($config['mysql_host'],$config['mysql_user'],$config['mysql_pass']);
	//select database
	@mysql_select_db($config['db_name']) or die( "Unable to select database");
	
?>
