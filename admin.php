<?
//session_start();	// start session

include 'header.php'; 
$conn=dbConnect();

$aname=$_POST['aname'];
$apsw=$_POST['apsw'];

$sql="SELECT aid FROM admin WHERE aname='$aname' and apsw='$apsw'";

$result=mysql_query($sql,$conn);

$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);

if($count==1)
{
//	$_SESSION['login_user']=$aname;
//	$_SESSION['password']=$apsw;
	setcookie("user", $aname, time()+3600);
	header("location: manage.php");

//	echo"<script language=\"javascript\">location.href=\"manage.php\";</script>";
}
else
{
	echo"Administrator Login:

	<form action='admin.php' method='POST'>
		<p>Username: <input type='text' name='aname'>
		<p>Password: <input type='password' name='apsw'>
		<input type='submit' value='login' onclick='test()'>
	</form>
	<font color='red'> Your username or password is invalid, please login again.</font>
";

}

?>


