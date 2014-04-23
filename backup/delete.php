<?php

include 'headerxml.php';

$del_pid = $_POST['del_pid'];

echo $_POST['del_pid'];
echo $del_pid;
echo "hello";

$sql = "DELETE FROM ".$config['table_name']." WHERE pid='$del_pid'";
$result = mysql_query($sql);

if (!$result)
{
        die('Invalid query: ' . mysql_error());
}
mysqli_close($conn);

// ***jump back to htm!!!!http://wenwen.soso.com/z/q220935074.htm 
echo"<script language=\"javascript\">location.href=\"manage.php\";</script>";
?>

