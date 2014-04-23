<?php

	include 'header.php'; 
	$conn=dbConnect();

        $sql="SELECT * FROM products WHERE special='weekly'";
        $result=mysql_query($sql,$conn);
	$daily=array();

        if(!$result) { die("No weekly specials.");}
	
	$json=array();

	if(mysql_num_rows($result)){
		while($row=mysql_fetch_object($result)){
			$json[]=$row;
		}
	}

	mysql_close($conn);

	echo '{"weekly":'.json_encode($json).'}';
	
?>	
