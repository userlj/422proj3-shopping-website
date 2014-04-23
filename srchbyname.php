<html>
<head>
	<title>search results</title>
	<link rel="stylesheet" type="text/css" href="shopping.css">
	<link rel="shortcut icon" href="../images/icon/meng_full.ico"/>
</head>
<body>
<?
if (isset($_COOKIE["user"]))
	echo "Welcome " . $_COOKIE["user"] . "!<a class='link' href='logout.php'>Logout</a><br>";
else
	echo "<a class='link' href='shopper.html'>Shopper Login</a>";
?>


	<a class="link" href="admin.html">Admin Login</a><p>

	<form>
	<input class='cart' type="button" value="Shopping Cart" onclick="window.location.href='addtocart.php'"> 
	</form>
<?
include 'header.php'; 
$conn=dbConnect();


if (isset($_COOKIE["user"]))
{
	$user = $_COOKIE["user"];
}


$category = $_POST['categorylist'];
$srchname = $_POST['srchname'];

if($srchname=='')
{
	echo"<script language=\"javascript\">location.href=\"index.php\";</script>";
}

if($category=='all' || $category=='')
{
	$sql="SELECT * FROM products WHERE pname LIKE '%{$srchname}%'";
}
else
{
	$sql="SELECT * FROM products WHERE category='$category' AND pname LIKE '%{$srchname}%'";
}

$result=mysql_query($sql,$conn);
if(!$result) { die("No matching results!");}


echo "<table>";
while($row = mysql_fetch_array($result))
{

	echo "<form action='addtocart.php' method='POST'><tr>";

	echo "<td><input name='pid' type='hidden' value='".$row['pid']."'></td>";
	echo "<td><input name='pname' type='hidden' value='".$row['pname']."'></td>";
	echo "<td><input name='price' type='hidden' value='".$row['price']."'><td>";

	echo "<td>" . "<a href=".$row['pimg']."><img class='nail' src=".$row['pimg'] . "></a></td>";
	echo "<td>" . $row['pname'] . "</td>";
	echo "<td>" . $row['pdesc'] . "</td>";
	echo "<td>$" . $row['price'] . "</td>";

	echo "<td><input id='button1' type='submit' value='add to cart'></td>";

	echo "</tr></form>";

}

echo "</table>";
mysql_close($conn);

?>
<a class="link" href="index.php">Back to store</a>
	<div id="footer">
		<span class="fleft">Project3 -- Shopping Website</span>
		<span class="fright">
			<a class="link" href="http://harvey.binghamton.edu/~lmeng4">Lingjie's Home Page</a>
		</span>
	</div><!--footer-->
</body>
</html>
