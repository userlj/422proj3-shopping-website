<?
//session_start();	// start session

include 'header.php'; 
$conn=dbConnect();

$sname=$_POST['sname'];
$spsw=$_POST['spsw'];

$sql="SELECT sid FROM shopper WHERE sname='$sname' and spsw='$spsw'";

$result=mysql_query($sql,$conn);

$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);

if($count==1)
{
//	$_SESSION['login_user']=$sname;
//	$_SESSION['password']=$spsw;
	//header("location: index.php");

	setcookie("user", $sname, time()+3600);
	header("location: index.php");
//	echo"<script language=\"javascript\">location.href=\"index.php\";</script>";
}
else
{
	echo"Shopper Login:

	<form action='shopper.php' method='POST'>
		<p>Username: <input type='text' name='sname'>
		<p>Password: <input type='password' name='spsw'>
		<input type='submit' value='login'>
	</form>
	<font color='red'> Your username or password is invalid, please login again.</font>
";

}

?>


