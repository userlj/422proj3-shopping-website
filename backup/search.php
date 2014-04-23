<?

include 'header.php'; 
$conn=dbConnect();

$category = $_GET['category'];

//$srchname = $_POST['srchname'];

if($category=='all')
{
	$sql="SELECT * FROM products";
}
else
{
	$sql="SELECT * FROM products WHERE category='".$category."'";
}

$result=mysql_query($sql,$conn);
if(!$result) { die("No matching results.");}

echo "<table>";
while($row = mysql_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . "<a href=".$row['pimg']."><img class='nail' src=".$row['pimg'] . "></a></td>";
	echo "<td>" . $row['pname'] . "</td>";
	echo "<td>" . $row['pdesc'] . "</td>";
	echo "<td>$" . $row['price'] . "</td>";
	echo "<td><button>add to cart</button></td>";
	echo "</tr>";
}

echo "</table>";
mysql_close($con);

?>
