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
$uexp = $_POST['nexp'];


$sql = "UPDATE products
	SET pname='$pname', pdesc='$pdesc', category='$category', 
	price='$price', pimg='$pimg', special='$special', expdate='$uexp'
	WHERE pid='$pid'";

$result = mysql_query($sql,$conn);

if (!$result)
{
	echo"<a href='manage.php'>Update Again</a><p>";
        die('Invalid query: ' . mysql_error());
}
mysql_close($conn);

echo"<script language=\"javascript\">location.href=\"manage.php\";</script>";
?>

