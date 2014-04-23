<?php
	//Connect to database
	function dbConnect()
	{
		$dbhost = 'bigyellowcat.cs.binghamton.edu';
		$dbuser = 'meng';
		$dbpass = 'meng7842';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('meng');
		return $conn;
	}

?>