<?php

	include 'header.php'; 
	$conn=dbConnect();

        $sql="SELECT * FROM products WHERE special='daily'";
        $result=mysql_query($sql,$conn);
	$daily=array();

        if(!$result) { die("No daily specials.");}
	
	$json=array();

	if(mysql_num_rows($result)){
		while($row=mysql_fetch_object($result)){
			$json[]=$row;
		}
	}

	mysql_close($conn);

	echo '{"daily":'.json_encode($json).'}';
	
?>	
	

