<?php

	include 'header.php'; 
	$conn=dbConnect();

        $sql="SELECT DISTINCT category FROM products ORDER BY category ASC";
        $result=mysql_query($sql,$conn);
	$daily=array();

        if(!$result) { die("Category not found.");}
	
	$json=array();

	if(mysql_num_rows($result)){
		while($row=mysql_fetch_object($result)){
			$json[]=$row;
		}
	}

	mysql_close($conn);

	echo '{"category":'.json_encode($json).'}';
	
?>
