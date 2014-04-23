<? 
/*session_start();

$aname=$_SESSION['aname'];
$apsw=$_SESSION['apsw'];
$_SESSION['login_user']=$aname;
$_SESSION['password']=$apsw;
*/

if (isset($_COOKIE["user"]))
  echo "Welcome " . $_COOKIE["user"] . "!<a href='logout.php'>Logout</a><br>";
else
  echo "<a href='admin.html'>Admin Login</a>";

?>

<html>
<head>

<title>management page</title>
<link rel="stylesheet" type="text/css" href="shopping.css">

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="validation.js"></script>
<script type='text/javascript'>

$(document).ready(function(){
	$.ajax({
		url : "category.php",
		dataType: "json",
		success : function(data){
			var categorylist = '<option value="">Select category:</option>';
			$.each($(data.category), function () {
			categorylist += '<option value='+this.category+'>' + this.category + '</option>';
			});
			$('#ncategory').append(categorylist);
		}
	});

	$.ajax({
		url : "category.php",
		dataType: "json",
		success : function(data){
			var categorylist = '<option value="">Select category:</option>';
			$.each($(data.category), function () {
			categorylist += '<option value='+this.category+'>' + this.category + '</option>';
			});
			$('#ucategory').append(categorylist);
		}
	});
});

var productArray = new Array();	// store person objects in an array


var mark = 0;	// the index of Person object that in the first row
var markdown = 0;

var del_index = 0;

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


function printProduct(pos, arrIndex)	// print product object
{
	document.getElementById("pid"+pos).value = productArray[arrIndex].pid;
        document.getElementById("pimg"+pos).value = productArray[arrIndex].pimg;
        document.getElementById("pname"+pos).value = productArray[arrIndex].pname;
        document.getElementById("pdesc"+pos).value = productArray[arrIndex].pdesc;
	document.getElementById("category"+pos).value = productArray[arrIndex].category;
        document.getElementById("price"+pos).value = productArray[arrIndex].price;
        document.getElementById("special"+pos).value = productArray[arrIndex].special;
        document.getElementById("exp"+pos).value = productArray[arrIndex].expdate;
}


function clear(index)	// clear text fields after adding a new object
{
	document.getElementById("pid"+index).value = "";
	document.getElementById("pimg"+index).value = "";
	document.getElementById("pname"+index).value = "";
	document.getElementById("pdesc"+index).value = "";
	document.getElementById("category"+index).value = "";
	document.getElementById("price"+index).value = "";
	document.getElementById("special"+index).value = "";
	document.getElementById("exp"+index).value = "";
}


function add()
{
	if(!validateForm("addForm"))    // form is not validate
	{
		return false;
	}
	else
	{
		alert("A new record will be added!");
		showCat();
	}
}

function update()
{
	if(!validateForm("updateForm"))    // form is not validate
	{
		return false;
	}
	else
	{
		alert("This record will be updated!");
		showCat();
	}
}


function down()	// scroll down
{
	len = productArray.length;
	document.getElementById("btnup").disabled = false;
	if(mark >= len - 5)
	{
		// already at the end, invalid the button
		// or print a message
		document.getElementById("btndown").disabled = true;//gai
	}
	else
	{
		// scroll down
		for(var i=1; i<=5; i++)
		{
			printProduct(i,mark+i);
		}
		mark++;
	}
	return false;
}


function up()	// scroll up
{
	//alert("from up");
	len = productArray.length;
	document.getElementById("btndown").disabled = false;//gai
	if(mark == 0)
	{
		// already at the top, invalid the button
		// or print a message
		// disableUpButton();					
		document.getElementById("btnup").disabled = true;//gai

	}
	else
	{
		//enableUpButton();
		for(var i=1; i<=5; i++)
		{
			printProduct(i, mark-2+i);
		}
		mark--;
	}
	return false;
}


function del()	// delete element of personArray
{
	for (var i=1; i<=5; i++) 
	{
		if (document.getElementById("del"+i).checked) 
		{
			if(len<=5) 
			{
				// pass i to php and delete the ith element
				del_index = i-1;
				document.getElementById('del_pid').value=productArray[del_index].pid;
			} 
                        else // length > 5
			{
				// pass i-1+mark to php, delete (i-1+mark)th
				del_index = i-1+mark;
				document.getElementById('del_pid').value=productArray[del_index].pid;
    			}
		}
	}
}

/*function select()
{
	for (var i=1; i<=5; i++) 
	{
		if (document.getElementById("del"+i).checked) 
		{
			document.getElementById('upid').value=document.getElementById("pid1").value;
			document.getElementById('upimg').value=document.getElementById("pimg"+i).value;
			document.getElementById('upname').value=document.getElementById("pname"+i).value;
			document.getElementById('updesc').value=document.getElementById("pdesc"+i).value;
			document.getElementById('ucategory').value=document.getElementById("category"+i).value;
			document.getElementById('uprice').value=document.getElementById("price"+i).value;
			document.getElementById('uspecial').value=document.getElementById("special"+i).value;
			document.getElementById('uexp').value=document.getElementById("exp"+i).value;
		}
	}
}*/



function showCat()
{
	if (window.XMLHttpRequest)
	{	// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{	// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	productArray = [];

	xmlhttp.onreadystatechange=function()
	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			xmlDoc=xmlhttp.responseXML;	// get response as XML file

			var prod=xmlDoc.getElementsByTagName("product");

			for (var i=0;i<prod.length;i++)	// add new product
  			{
			  	var pid=prod[i].getElementsByTagName("pid")[0].childNodes[0].nodeValue;
  				var pname=prod[i].getElementsByTagName("pname")[0].childNodes[0].nodeValue;
  				var pdesc=prod[i].getElementsByTagName("pdesc")[0].childNodes[0].nodeValue;
  				var category=prod[i].getElementsByTagName("category")[0].childNodes[0].nodeValue;
				var price=prod[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
  				var pimg=prod[i].getElementsByTagName("pimg")[0].childNodes[0].nodeValue;
  				var special=prod[i].getElementsByTagName("special")[0].childNodes[0].nodeValue;
  				var expdate=prod[i].getElementsByTagName("expdate")[0].childNodes[0].nodeValue;
				var newProduct = new Product(pid, pimg, pname, pdesc, category, price, special, expdate);

				productArray.push(newProduct);

  			}


			len = productArray.length

			if(len<=5)
			{
				mark = 0;
				for(var i=1; i<=len; i++)
				{
					printProduct(i,i-1);
				}
			} 
			else
			{
				document.getElementById("btnup").disabled = false;
				mark = 	len - 5;
				for(var i=1; i<=5; i++)
				{
					printProduct(i,len-6+i);
				}
			}
			clear("i");

		}
	}
	xmlhttp.open("GET","mysqldb2xml.php",true);
	xmlhttp.send();
}


</script>
</head>

<body onload="showCat()">
<a href="shopper.html">Shopper Login</a><p>
Products catalog:
<p>
<form name="myForm">
<table>
	<tr>
		<th>select</th><th>pid</th><th>pimg</th><th>pname</th><th>pdesc</th>
		<th>category</th><th>price</th><th>special</th><th>exp</th>
	</tr>
	<tr>
		<td><input type="radio" name="del" id="del1"></td>
		<td><input class="id" type="text" name="pid1" id="pid1" readonly></td>
		<td><input class="add" type="text" name="pimg1" id="pimg1" readonly></td>
		<td><input class="add" type="text" name="pname1" id="pname1" readonly></td>
		<td><input class="desc" type="text" name="pdesc1" id="pdesc1" readonly></td>
		<td><input class="cat" type="text" name="category1" id="category1" readonly></td>
		<td><input class="cat" type="text" name="price1" id="price1" readonly></td>
		<td><input class="cat" type="text" name="special1" id="special1" readonly></td>
		<td><input class="date" type="text" name="exp1" id="exp1" readonly></td>
		<td><input type="button" id="btnup" disabled=true onclick="return up()" value="Scroll Up" style="width:90px"></td>
	</tr>
	<tr>
		<td><input type="radio" name="del" id="del2"></td>
		<td><input class="id" type="text" name="pid2" id="pid2" readonly></td>
		<td><input class="add" type="text" name="pimg2" id="pimg2" readonly></td>
		<td><input class="add" type="text" name="pname2" id="pname2" readonly></td>
		<td><input class="desc" type="text" name="pdesc2" id="pdesc2" readonly></td>
		<td><input class="cat" type="text" name="category2" id="category2" readonly></td>
		<td><input class="cat" type="text" name="price2" id="price2" readonly></td>
		<td><input class="cat" type="text" name="special2" id="special2" readonly></td>
		<td><input class="date" type="text" name="exp2" id="exp2" readonly></td>
	</tr>
	<tr>
		<td><input type="radio" name="del" id="del3"></td>
		<td><input class="id" type="text" name="pid3" id="pid3" readonly></td>
		<td><input class="add"type="text" name="pimg3" id="pimg3" readonly></td>
		<td><input class="add" type="text" name="pname3" id="pname3" readonly></td>
		<td><input class="desc" type="text" name="pdesc3" id="pdesc3" readonly></td>
		<td><input class="cat" type="text" name="category3" id="category3" readonly></td>
		<td><input class="cat" type="text" name="price3" id="price3" readonly></td>
		<td><input class="cat" type="text" name="special3" id="special3" readonly></td>
		<td><input class="date" type="text" name="exp3" id="exp3" readonly></td>
	</tr>
	<tr>
		<td><input type="radio" name="del" id="del4"></td>
		<td><input class="id" type="text" name="pid4" id="pid4" readonly></td>
		<td><input class="add" type="text" name="pimg4" id="pimg4" readonly></td>
		<td><input class="add" type="text" name="pname4" id="pname4" readonly></td>
		<td><input class="desc" type="text" name="pdesc4" id="pdesc4" readonly></td>
		<td><input class="cat" type="text" name="category4" id="category4" readonly></td>
		<td><input class="cat" type="text" name="price4" id="price4" readonly></td>
		<td><input class="cat" type="text" name="special4" id="special4" readonly></td>
		<td><input class="date" type="text" name="exp4" id="exp4" readonly></td>
	</tr>
	<tr>
		<td><input type="radio" name="del" id="del5"></td>
		<td><input class="id" type="text" name="pid5" id="pid5" readonly></td>
		<td><input class="add" type="text" name="pimg5" id="pimg5" readonly></td>
		<td><input class="add" type="text" name="pname5" id="pname5" readonly></td>
		<td><input class="desc" type="text" name="pdesc5" id="pdesc5" readonly></td>
		<td><input class="cat" type="text" name="category5" id="category5" readonly></td>
		<td><input class="cat" type="text" name="price5" id="price5" readonly></td>
		<td><input class="cat" type="text" name="special5" id="special5" readonly></td>
		<td><input class="date" type="text" name="exp5" id="exp5" readonly></td>
		<td><input type="button" id="btndown" disabled=true onclick="return down()" style="width:90px" value="Scroll Down"></td>
	</tr>
</table>
</form>
<hr>
Select and delete product:<p>
<form action="delete.php" method="post">
	<input type="hidden" id="del_pid" name="del_pid">
	<input type="submit" value="Delete" onclick="return del();" style="width:80px">
</form>

<hr>
Select and update product:<p>

	<input type="button" value="Select to edit" onclick="

	for (var i=1; i<=5; i++) 
	{
		if (document.getElementById('del'+i).checked) 
		{
			
			document.getElementById('upid').value=document.getElementById('pid'+i).value;
			document.getElementById('upimg').value=document.getElementById('pimg'+i).value;
			document.getElementById('upname').value=document.getElementById('pname'+i).value;
			document.getElementById('updesc').value=document.getElementById('pdesc'+i).value;
			document.getElementById('ucategory').value=document.getElementById('category'+i).value;
			document.getElementById('uprice').value=document.getElementById('price'+i).value;
			document.getElementById('uspecial').value=document.getElementById('special'+i).value;
			document.getElementById('uexp').value=document.getElementById('exp'+i).value;
		}
	} ">
<table>
	<tr>
		<th>pid</th>
		<th>pimg</th>
		<th>pname</th>
		<th>pdesc</th>
		<th>category</th>
		<th>price</th>
		<th>special</th>
		<th>exp</th>
	</tr>
	<tr>
		<form name="updateForm" action="update.php" method="POST">
		<td><input class="id" type="text" id="upid" name="npid" readonly></td>
		<td><input class="add" type="text" id="upimg" name="npimg"></td>
		<td><input class="add" type="text" id="upname" name="npname"></td>
		<td><input class="desc" type="text" id="updesc" name="npdesc"></td>
		<td><select id="ucategory" name="ncategory"></select></td>
		<td><input class="cat" type="text" id="uprice" name="nprice"></td>
		<td><select id="uspecial" name="nspecial">
			<option value="">Select special:</option>
			<option value="N/A">N/A</option>
			<option value="daily">daily</option>
			<option value="weekly">weekly</option>
		</select></td>
		<td><input class="date" type="text" id="uexp" name="nexp"></td>
		<td><input type="submit" value="Update" onclick="return update();" style="width:90px"></td>
		</form>

	</tr>
</table>
<hr>
Add product:<p>

<table>
	<tr>
		<th>pid</th>
		<th>pimg</th>
		<th>pname</th>
		<th>pdesc</th>
		<th>category</th>
		<th>price</th>
		<th>special</th>
		<th>exp</th>
	</tr>
	<tr>
		<form name="addForm" action="add.php" method="POST">
		<td><input class="id" type="text" id="npid" name="npid"></td>
		<td><input class="add" type="text" id="npimg" name="npimg"placeholder="img/image.jpg"></td>
		<td><input class="add" type="text" id="npname" name="npname"placeholder="book"></td>
		<td><input class="desc" type="text" id="npdesc" name="npdesc"placeholder="description"></td>
		<td><select id="ncategory" name="ncategory"></select></td>
		<td><input class="cat" type="text" id="nprice" name="nprice"placeholder="12.00"></td>
		<td><select id="nspecial" name="nspecial">
			<option value="">Select special:</option>
			<option value="N/A">N/A</option>
			<option value="daily">daily</option>
			<option value="weekly">weekly</option>
		</select></td>
		<td><input class="date" type="text" id="nexp" name="nexp"placeholder="mm/dd/yyyy or N/A"></td>
		<td><input type="submit" value="Add" onclick="return add();" style="width:90px"></td>
		</form>
	</tr>
</table>

</body>
</html>
