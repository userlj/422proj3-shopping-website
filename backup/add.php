<?php

include 'header.php';
$conn=dbConnect();

$pid = $_POST['npid'];
$pimg = $_POST['npimg'];
$pname = $_POST['npname'];
$pdesc = $_POST['npdesc'];
$category = $_POST['ncategory'];
$price = $_POST['nprice'];
$special = $_POST['nspecial'];
$exp = $_POST['nexp'];


$sql = "INSERT INTO products VALUES (
		'$pid', '$pname', '$pdesc', '$category', 
		'$price', '$pimg', '$special', '$exp')";

$result = mysql_query($sql,$conn);

if (!$result)
{
	echo"<a href='manage.php'>Add Again</a><p>";
        die('Invalid query: ' . mysql_error());
}
mysql_close($conn);

echo"<script language=\"javascript\">location.href=\"manage.php\";</script>";
?>

