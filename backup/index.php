<?php
if (isset($_COOKIE["user"]))
  echo "Welcome " . $_COOKIE["user"] . "!<a href='logout.php'>Logout</a><br>";
else
  echo "<a href='shopper.html'>Shopper Login</a>";
?>
<html>
<head>
	<link rel="shortcut icon" href="../images/icon/meng_full.ico"/>
	<link rel="stylesheet" type="text/css" href="shopping.css">
	<title>Lingjie-CS422-Proj3</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type='text/javascript'>

var cartArray = new Array();	// store objects in an array
var cartlist = '';
var len=cartArray.length;

function newWin(url,name, width, height) { 
	window.open(url,name,'scrollbars=yes,resizable=yes, width=' + width + ',height='+height);
}
/*
 onclick='+'"var newProduct = new Product('+pid+','+pimg+','+pname+','+pdesc+','+category+','+price+','+special+','+expdate');cartArray.push(newProduct);printCart()'+'"
*/
$(document).ready(function(){

	$.ajax({
		url : "daily.php",
		dataType: "json",
		success : function(result){
			var dailylist = '';
			$.each($(result.daily), function () {

				var pid=this.pid;
				var pimg=this.pimg;
				var pname=this.pname;
				var pdesc=this.pdesc;
				var category=this.category;
				var price=this.price;
				var special=this.special;
				var expdate=this.expdate;

				var newProd=new Product(pid, pimg, pname, pdesc, category, price, special, expdate);
				cartArray.push(newProd);

				dailylist += '<tr><td><a href='+pimg+'><img class="nail" src="' + pimg + 
				'"></a></td><td>' + expdate + "</td><td>" + pdesc + "</td><td>$" + price + 
				'</td><td>' + '<button onclick="printCart(0)">add to cart</button></td></tr>';
			});
			$('#dailylist').append(dailylist);

		}
	});

	$.ajax({
		url : "weekly.php",
		dataType: "json",
		success : function(data){
			var weeklylist = '';
			$.each($(data.weekly), function () {

				var pid=this.pid;
				var pimg=this.pimg;
				var pname=this.pname;
				var pdesc=this.pdesc;
				var category=this.category;
				var price=this.price;
				var special=this.special;
				var expdate=this.expdate;

				var newProd=new Product(pid, pimg, pname, pdesc, category, price, special, expdate);
				cartArray.push(newProd);

				weeklylist += '<tr><td><a href='+this.pimg+'><img class="nail" src="' + this.pimg + 
				'"></a></td><td>' + this.expdate + "</td><td>" + this.pdesc + "</td><td>$" + this.price + 
				'</td><td>' +'<button onclick="printCart(2)">add to cart</button></td></tr>';
			});
			$('#weeklylist').append(weeklylist);
		}
	});

	$.ajax({
		url : "category.php",
		dataType: "json",
		success : function(data){
			var categorylist = '<option value="">Select category:</option><option>all</option>';
			$.each($(data.category), function () {
				categorylist += '<option value='+this.category+'>' + this.category + '</option>';
			});
			$('#categorylist').append(categorylist);
		}
	});

});

function showSrch(str)
{
	if (str=="")
	{
		document.getElementById("txtHint").innerHTML="";
		return;
	}

	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		}
	}

	xmlhttp.open("GET","search.php?category="+str,true);
	xmlhttp.send();
}




function Product(pid, pimg, pname, pdesc, category, price, special, expdate)	// Product object
{
	this.pid = pid;
        this.pimg = pimg;
        this.pname = pname;
        this.pdesc = pdesc;
	this.category = category;
	this.price = price;
	this.special = special;
	this.expdate = expdate;
}


	
//	cartArray.push(newProduct);




function printCart(index)	// print product object
{

	cartlist = '<td><a href='+cartArray[index].pimg+'><img class="nail" src="' + cartArray[index].pimg + 
	'"></a></td><td>' + cartArray[index].expdate + "</td><td>" + cartArray[index].pdesc + "</td><td>" + 
	cartArray[index].price + '</td>';

	$('#cart').append("<tr>"+cartlist+"</tr>");

}


</script>
</head>

<body>


	<a href="admin.html">Admin Login</a>
<!--	<a href="cart.php">Cart: 0 items</a>-->
<p>
Cart:
<p>
<table name="cart" id="cart">

<table>
<div id="test"></div>

<p>Daily Specials:
<table id="dailylist"></table>
<p>Weekly Specials:
<table id="weeklylist"></table>

<p>Search for products:

<form>
	<p>Category:
	<select id="categorylist" name="categorylist" onchange="showSrch(this.value)"></select>
<!--	<input type="text" name="srchname">-->
<!--	<input type="submit">-->

</form>


<table id="searchlist"></table>
<div id="txtHint"></div>
</body>
</html>
