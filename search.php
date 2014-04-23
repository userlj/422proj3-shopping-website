<?

include 'header.php'; 
$conn=dbConnect();


if (isset($_COOKIE["user"]))
{
	$user = $_COOKIE["user"];
}


$category = $_GET['category'];

//$srchname = $_POST['srchname'];

if($category=='all')
{
	$sql="SELECT * FROM products ORDER BY pname ASC";
}
else
{
	$sql="SELECT * FROM products WHERE category='".$category."' ORDER BY pname ASC";
}

$result=mysql_query($sql,$conn);
if(!$result) { die("No matching results.");}


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
