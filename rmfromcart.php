<html>
<head>
	<link rel="stylesheet" type="text/css" href="shopping.css">
	<link rel="shortcut icon" href="../images/icon/meng_full.ico"/>
	<title>cart list</title>

</head>
<body>
<?

include 'header.php'; 
$conn=dbConnect();


if (isset($_COOKIE["user"]))
{
	$user = $_COOKIE["user"];
	echo "Welcome " . $user . "!<a href='logout.php'>Logout</a><br>";
	echo "<a href='admin.html'>Admin Login</a><p>";
}
else
{
	echo "<script language=\"javascript\">location.href=\"index.php\";</script>";
}

$pid = $_POST['pid'];
$qty = $_POST['qty'];
$price = $_POST['price'];
$remove = $_POST['remove'];
$update = $_POST['update'];


if($user=='')
{
	echo "Please login.";
}
else
{

	if($_POST['remove'])
	{
		$sql1 = "DELETE FROM ".$user." WHERE pid=".$pid;
	}

	if($_POST['update'])
	{
		$unitpricequery = "SELECT price FROM products WHERE pid='$pid'";
		$unitpriceresult = mysql_query($unitpricequery,$conn);

		if(!$unitpriceresult) 
		{
			echo "<font color='red'>error selecting unitprice</font>";
			die(mysql_error());
		}
/*		else
		{
			echo"<font color='blue'>unitprice selected</font>";
		}*/
		$unitpricerow = mysql_fetch_array($unitpriceresult);
		$unitprice = $unitpricerow['price'];
		$totalprice = $unitprice*$qty;


		$sql1 = "UPDATE ".$user." SET qty='$qty', price='$totalprice' WHERE pid='$pid'";
	}

	$sql2 = "SELECT * FROM ".$user;
}

$result1=mysql_query($sql1,$conn);
if(!$result1) 
{
	echo "<font color='red'>error deleting/updating</font>";
	die(mysql_error());
}
else
{
	echo"<font color='blue'>deleted/updated</font>";
}

$result2=mysql_query($sql2,$conn);
if(!$result2) 
{
	echo "<font color='red'>error selecting</font>";
	die(mysql_error());
}


echo "<table class='cart'>";
echo "<tr>";
echo "<th>pid</td>";
echo "<th>pname</td>";
echo "<th>qty</td>";
echo "<th>price</td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";
while($row = mysql_fetch_array($result2))
{
	echo "<form action='rmfromcart.php' method='POST'>";
	echo "<tr>";
	echo "<td class='cart'><input readonly class='id' name='pid' value='" . $row['pid'] . "'></td>";
	echo "<td class='cart'>" . $row['pname'] . "</td>";
	echo "<td class='cart'><input class='id' name='qty' value='" . $row['qty'] . "'></td>";
	echo "<td class='cart'>$<input readonly class='cat' name='price' value='" . $row['price'] . "'></td>";
	echo "<td><input type='submit' name='update' value='update'></td>";
	echo "<td><input type='submit' name='remove' value='remove'></td>";
	echo "</tr>";
	echo "</form>";
}

echo "</table>";

mysql_close($conn);

?>

<p><a href="index.php"><---Continue shopping</a>
	<div id="footer">
		<span class="fleft">Project3 -- Shopping Website</span>
		<span class="fright">
			<a class="link" href="http://harvey.binghamton.edu/~lmeng4">Lingjie's Home Page</a>
		</span>
	</div><!--footer-->
</body>
</html>
