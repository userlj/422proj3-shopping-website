
<html>
<head>
	<title>Lingjie-CS422-Proj3</title>
	<link rel="stylesheet" type="text/css" href="shopping.css">
	<link rel="shortcut icon" href="../images/icon/meng_full.ico"/>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type='text/javascript'>

//var cartArray = new Array();	// store objects in an array
var cartlist = '';
//var len=cartArray.length;

function newWin(url,name, width, height) { 
	window.open(url,name,'scrollbars=yes,resizable=yes, width=' + width + ',height='+height);
}

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
//				len=cartArray.length;
				var newProd=new Product(pid, pimg, pname, pdesc, category, price, special, expdate);
//				cartArray.push(newProd);

				dailylist += '<form class="tr" action="addtocart.php" method="POST"><span class="td"><input name="pid" type="hidden" value="'+pid+'"></span><span class="td"><input name="pname" type="hidden" value="'+pname+'"></span><span class="td"><a href='+pimg+'><img class="nail" src="' + pimg + '"></a></span><span class="td">' + expdate + "</span><span class='td'>" + pdesc + '</span><span class="td">$' + price + '</span><span class="td"><input name="price" type="hidden" value="'+price+'"></span><span class="td">' + '<input type="submit" id="button1" value="add to cart"></span></form>';

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
//				len=cartArray.length;
				var newProd=new Product(pid, pimg, pname, pdesc, category, price, special, expdate);
//				cartArray.push(newProd);

				weeklylist += '<form class="tr" action="addtocart.php" method="POST"><span class="td"><input name="pid" type="hidden" value="'+pid+'"></span><span class="td"><input name="pname" type="hidden" value="'+pname+'"></span><span class="td"><a href='+pimg+'><img class="nail" src="' + pimg + '"></a></span><span class="td">' + expdate + "</span><span class='td'>" + pdesc + '</span><span class="td">$' + price + '</span><span class="td"><input name="price" type="hidden" value="'+price+'"></span><span class="td">' + '<input type="submit" id="button1" value="add to cart"></span></form>';

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

	cartlist = '<td><a href='+cartArray[index].pimg+'><img class="nail" src="' + cartArray[index].pimg + '"></a></td><td>' + cartArray[index].expdate + "</td><td>" + cartArray[index].pdesc + "</td><td>" + cartArray[index].price + '</td>';

	$('#cart').append("<tr>"+cartlist+"</tr>");

}


</script>
</head>

<body>

<div id="wrapper">

<?php
if (isset($_COOKIE["user"]))
	echo "Welcome " . $_COOKIE["user"] . "!<a class='link' href='logout.php'>Logout</a><br>";
else
	echo "<a class='link' href='shopper.html'>Shopper Login</a>";
?>


	<a class="link" href="admin.html">Admin Login</a><p>

	<form>
	<input class='cart' type="button" value="Shopping Cart" onclick="window.location.href='addtocart.php'"> 
	</form>

<div class="heading">Welcome to Lingjie's Shop!</div>

	<div id="content">
		<div class="article">
<p><h2>Daily Specials:</h2>
<div class="table" id="dailylist"></div>


<p><h2>Weekly Specials:</h2>
<div class="table" id="weeklylist"></div>

<p><h2>Search for products:</h2>

<form action="srchbyname.php" method="POST">
	<p>Category:
	<select id="categorylist" name="categorylist" onchange="showSrch(this.value)"></select>
	<input type="text" id="srchname" name="srchname">
	<input type="submit">

</form>

	<div id="txtHint"></div>

		</div><!--article-->
	</div><!--content-->
	<div id="footer">
		<span class="fleft">Project3 -- Shopping Website</span>
		<span class="fright">
			<a class="link" href="http://harvey.binghamton.edu/~lmeng4">Lingjie's Home Page</a>
		</span>
	</div><!--footer-->
</div><!--wrapper-->
</body>
</html>
