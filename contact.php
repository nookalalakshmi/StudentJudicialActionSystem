<html>
<script>
function validate()
{
	var x=document.forms["form1"]["subject"].value;
	if (x.length < 1)
	{
		alert("Enter a subject line");
		return false;
	}
	
	var y=document.forms["form1"]["customer_mail"].value;
	//alert(y.length);
	//if (y.length < 1)
	//{
	//	alert("Invalid Email");
	//	return false;
	//}
	//alert(y.length);
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	//alert(mailformat);
	if(y.match(mailformat))  
{  
//document.form1.text1.focus();  
return true;  
}  
else  
{  
alert("You have entered an invalid email address!");  
//document.form1.text1.focus();  
return false;  
}  
}
</script>
<table width="400" border="0" align="center" cellpadding="3" cellspacing="1">
<tr>
<td><strong>Contact Form </strong></td>
</tr>
</table>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td><form name="form1" method="post" action="send_contact.php" onSubmit="return validate()">
<input name="pong" type="hidden" value="ping" />
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<td width="16%">Subject</td>
<td width="2%">:</td>
<td width="82%"><input name="subject" type="text" id="subject" size="50"></td>
</tr>
<tr>
<td>Detail</td>
<td>:</td>
<td><textarea name="detail" cols="50" rows="4" id="detail"></textarea></td>
</tr>
<tr>
<td>Name</td>
<td>:</td>
<td><input name="name" type="text" id="name" size="50"></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input name="customer_mail" type="text" id="customer_mail" size="50"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</html>