<?php

// this file is used in function showPerson() in myForm.htm

include 'headerxml.php';

$xml          = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$root_element = $config['table_name']; //fruits
$xml         .= "<$root_element>";


// select all items in table
$sql = "SELECT * FROM ".$config['table_name']." ORDER BY pid ASC";
 
$result = mysql_query($sql);

if (!$result) 
{
	die('Invalid query: ' . mysql_error());
}

if(mysql_num_rows($result)>0)
{
	while($result_array = mysql_fetch_assoc($result))
	{
		$xml .= "<product>";
 
      		//loop through each key,value pair in row
      		foreach($result_array as $key => $value)
      		{
         		//$key holds the table column name
         		$xml .= "<$key>";
 
         		//embed the SQL data in a CDATA element to avoid XML entity issues
         		$xml .= "$value";
 
         		//and close the element
         		$xml .= "</$key>";
      	}
 
	$xml.="</product>";
   	}
}

//close the root element
$xml .= "</$root_element>";

//send the xml header to the browser
header ("Content-Type:text/xml");

echo $xml;
mysqli_close($conn);
?>


