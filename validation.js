function validateForm(formName)
{
	var npid=document.forms[formName]["npid"].value;
	var npimg=document.forms[formName]["npimg"].value;
	var npname=document.forms[formName]["npname"].value;
	var npdesc=document.forms[formName]["npdesc"].value;
	var ncategory=document.forms[formName]["ncategory"].value;
	var nprice=document.forms[formName]["nprice"].value;
	var nspecial=document.forms[formName]["nspecial"].value;
	var nexp=document.forms[formName]["nexp"].value;

	// check if any fields are empty
	if (npid==null || npid=="" || npimg==null || npimg=="" || 
		npname==null || npname=="" || npdesc==null || npdesc=="" || 
		ncategory==null || ncategory=="" || nprice==null || nprice=="" ||
		nspecial==null || nspecial=="")
	{
		alert("Please Fill All Required Field");
		return false;
	}

	if(!validatePid(npid))
	{
		return false;
	}
	
	if(!validateImg(npimg))
	{
		return false;
	}
	if(!validateName(npname))
	{
		return false;
	}

	if(!validatePrice(nprice))
	{
		return false;
	}

	if(nexp!=null && nexp!="" && nexp!="N/A" && !validateDate(nexp))
	{
		return false;
	}


	return true;
}



function validatePid(npid)
{
	if (!(/^\d+$/.test(npid)))
	{
		alert("Pid Is Not In Proper Format\n\ne.g. 19");
		return false;
	}
	return true;
}

function validateImg(npimg)
{
	if (!(/^(img)\/[0-9a-zA-Z]+\.(png|gif|jpg|jpeg)$/.test(npimg)))
	{
		alert("Pimg Is Not In Proper Format\n\ne.g. img/image.jpg");
		return false;
	}
	return true;
}

function validateName(pname)
{
	if (!(/^[a-zA-Z ]+$/.test(pname)))
	{
		alert("Name Is Not In Proper Format\n\ne.g. wood sculpture");
		return false;
	}
	return true;
}

function validatePrice(price)
{
	if (!(/^\d+(\.\d{1,2})?$/.test(price)))
	{
		alert("num Is Not In Proper Format\n\ne.g. 1000.00");
		return false;
	}
	return true;
}

function validateDate(expdate)
{

	// Checks for the following valid date formats:
	// MM/DD/YYYY

	var datePat = /^(\d{2})(\/)(\d{2})(\/)(\d{4})$/;

	var matchArray = expdate.match(datePat); // is the format ok?

	if (matchArray == null) 
	{
		alert("Date Of Expiration Is Not In Proper Format\n\ne.g. MM/DD/YYYY or N/A")
		return false;
	}

	month = matchArray[1]; // parse date into variables
	day = matchArray[3];
	year = matchArray[5];

	if (month < 1 || month > 12)	// check month range
	{
		alert("Month Must Be Between 1 And 12");
		return false;
	}

	if (day < 1 || day > 31) 
	{
		alert("Day Must Be Between 1 And 31");
		return false;
	}

	if ((month==4 || month==6 || month==9 || month==11) && day==31) 
	{
		alert("Month "+month+" Doesn't Have 31 Days!")
		return false;
	}
	
	if (month == 2)	// check for february 29th
	{ 
		var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
		if (day>29 || (day==29 && !isleap)) 
		{
			alert("February " + year + " Doesn't Have " + day + " Days!");
			return false;
		}
	}

	return true;  // date is valid

}

