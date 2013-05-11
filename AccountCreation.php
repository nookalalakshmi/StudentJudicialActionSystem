<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Console</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.min.css">

<?php session_start();
include "DBConnect.php";

if(!isset($_SESSION['views']))
{
	header('Location: index.php');
}

$perm = $_SESSION['Permission'];
	
// set timeout period in seconds
$inactive = 600;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout'])) 
{
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{
		session_destroy(); 
		header("Location: index.php"); 
	}
}
$_SESSION['timeout'] = time();

?>

<script language="JavaScript">
<!--
function FP_swapImg() {//v1.0
 var doc=document,args=arguments,elm,n; doc.$imgSwaps=new Array(); for(n=2; n<args.length;
 n+=2) { elm=FP_getObjectByID(args[n]); if(elm) { doc.$imgSwaps[doc.$imgSwaps.length]=elm;
 elm.$src=elm.src; elm.src=args[n+1]; } }
}

function FP_preloadImgs() {//v1.0
 var d=document,a=arguments; if(!d.FP_imgs) d.FP_imgs=new Array();
 for(var i=0; i<a.length; i++) { d.FP_imgs[i]=new Image; d.FP_imgs[i].src=a[i]; }
}

function FP_getObjectByID(id,o) {//v1.0
 var c,el,els,f,m,n; if(!o)o=document; if(o.getElementById) el=o.getElementById(id);
 else if(o.layers) c=o.layers; else if(o.all) el=o.all[id]; if(el) return el;
 if(o.id==id || o.name==id) return o; if(o.childNodes) c=o.childNodes; if(c)
 for(n=0; n<c.length; n++) { el=FP_getObjectByID(id,c[n]); if(el) return el; }
 f=o.forms; if(f) for(n=0; n<f.length; n++) { els=f[n].elements;
 for(m=0; m<els.length; m++){ el=FP_getObjectByID(id,els[n]); if(el) return el; } }
 return null;
}

function ValidateInput(obj)
{
	var x=document.forms["form1"]["username"].value;
	var y=document.forms["form1"]["password"].value;
	var z=document.getElementById("txtStudent").value;
	
	re = /^\w+$/;
    if(!re.test(x))
	{
		alert("Username must contain only letters, numbers and underscores!");
		document.forms["form1"]["username"].focus();
		return false;
    }
	
	if(!re.test(z))
	{
		alert("Username must contain only letters, numbers and underscores!");
		document.forms["form1"]["username"].focus();
		return false;
    }
	
	if (y==null ||y=="")
	{
		alert("Password cannot be empty");
		document.forms["form1"]["password"].focus();
		return false;
	}
	
	if (document.forms["form1"]["password"].value.length < 6)
	{
		alert("Password must contain at least six characters");
		document.forms["form1"]["password"].focus();
		return false;
	}
	
	re = /[0-9]/;
	if(!re.test(y)) 
	{
		alert("Password must contain at least one number (0-9)!");
		document.forms["form1"]["password"].focus();
		return false;
	}
	
	re = /[a-zA-Z]/;
	if(!re.test(y)) 
	{
		alert("Password must contain at least one alphabet!");
		document.forms["form1"]["password"].focus();
		return false;
	}
}

function enableStudent()
{
	if (document.getElementById('rdStudent').value == "student")
	{
		document.getElementById("txtEmp").disabled=true;
		document.getElementById("txtStudent").disabled=false;
		document.getElementById("dropbox").disabled=true;
		if(document.getElementById("txtStudent").value==null || document.getElementById("txtStudent").value=="")
		{
			alert("Username cannot be empty");
			document.forms["form1"]["studentid"].focus();
		}
	}
}

function enableEmp()
{
	if (document.getElementById('rdEmployee').value == "employee")
	{
		document.getElementById("txtEmp").disabled=false;
		document.getElementById("txtStudent").disabled=true;
	}
	if(document.getElementById("txtEmp").value==null || document.getElementById("txtEmp").value=="")
			alert("Username cannot be empty");
}

// -->
</script>
<script type="text/javascript">

$(document).ready(function()
{

$('.autocompletestudent').autocomplete(
{
	
source: "StudentSearch4AutoComplete.php",
minLength: 3,

focus: function() {
// prevent value inserted on focus
return false;
},
change: function (event, ui) {
if (!ui.item) {
$(this).val('');
}
},
messages: {
noResults: null,
results: null
}
});
});
</script>

</head>

<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    <h1>Student Judicial Action      </h1>
    <h3>Manage Accounts <a style="float:right;margin-right:15%;" href ="http://www.cs.indiana.edu/cgi-pub/shrukest/Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3>
        <div class="clear">
          <p>Welcome, 
            <label accesskey="lblUser" class="clear">
              <?php 
					echo $_SESSION['username'];
			  ?>
            </label>
          </p>
      </div>
  </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>	
        	<li><a href="<?php if($perm == 1)
						{
							echo "StudentHome.php";
						}
						else
						{
							echo "Home_Page.php";
						} ?>">Home</a>
            </li>        
        </ul>
    </div>

    <div id="body">
		
        <?php
		
		if(isset($_POST['username']))
		{
			$username = $_POST['username'];
		}
		else
		{
			if( ($pos = strpos($_POST['studentid'], '/')) !== FALSE )
			$username = substr($_POST['studentid'], $pos + 1);
		}
		
		$password = $_POST['password'];
		$userid_del = $_POST['userid'];
			
		if(isset($_POST['SelectPermLevel']))
			$permission = $_POST['SelectPermLevel'];
		else
			$permission  = 1;	
		
		$perm = $_SESSION['Permission'];
		
		if(isset($_POST['submit']))
		{
			$sql = mysql_query ("select Userid from LoginInfo where userid = '$username';");
			$num = mysql_affected_rows();
			
			if($num == 1)
			{
				echo "<p> <b> <label style=\"color:red;\">User already exists </label></b> </p>";
			}
			else
			{
				$query = "insert into LoginInfo(Userid, Password, PermissionLevel) values('$username','$password','$permission');";
				$result = mysql_query ($query);
				
				if ($result) 
				{
					echo "<p> <b> Account created successfully </b> </p>";
				}
				else
				{
					echo "<p> Account not created </p>";
				}
			}
		}
		
		if(isset($_POST['delete']))
		{
			$result = mysql_query ("delete from LoginInfo where Userid = '$userid_del';");
			
			if ($result) 
			{
				echo "<p> <b> User account for $userid_del deleted </b> </p>";
			}
			else
			{
				echo "<p> Account not deleted </p>";
			}
		}
		
		?>
        
        <div id="content" style="width: 930px; height: 800px">
        	<form id="form1" method="post" action="<?php $_SERVER['AccountCreation.php']?>">
				<br /> <br /> <br />
                <h3> Create Account </h3>
                <p> <input type="radio" id = "rdEmployee" name="accountType" value="employee" onclick="enableEmp(this.checked)"> Employee
                 <input type="radio" id = "rdStudent" name="accountType" value="student" onclick="enableStudent(this.checked)">Student </p>
                              
				<table border="1">
					<tr>                        
						<td width="66%" align="right"> <b> Username: </b>
                        <br /> (Username must contain only letters, numbers and underscores)
                        </td>
						<td width="34%" align="left"> <p>&nbsp;
						  </p>
						  <p>
						    <input id="txtEmp" name="username" type="text" size="36" maxlength="30"> 
					      </p>
						  <p>
						    <input id="txtStudent" name="studentid" type="text" size="36" maxlength="30" class="autocompletestudent"></td>
					</tr>
                    
                    <tr>
						<td align="right"> <b> Password: </b>
                        <br /> (Password must be atleast 6 characters and must contain atleast one alphabet and one digit)
                        </td>
						<td align="left"> <input name="password" type="password" size="36" maxlength="20"> </td>
					</tr>
                    
                    <tr>
						<td align="right"> <b> Permission Level: </b> </td>
						<td align="left">
                            <select name="SelectPermLevel" id="dropbox">
	                         	<?php 
								$result = mysql_query("select * from Designation where Designationid in (2,3,4);");
								while ($data=mysql_fetch_assoc($result)){
								?>
								<option value ="<?php echo $data['Designationid'] ?>" > <?php echo $data['Description'] ?></option>
								<?php } ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                    	<td align="right"> <input class="formbutton" type="submit" name="submit" value="Create Account" onclick="return ValidateInput(this)"> </td>
                        <td align="left"> <input class="formbutton" type="reset" value="Clear"> </td>
					</tr>
				</table>
                <br /> <br /> <br />
                <h3> Delete Account </h3>
			  <table border="1">
					<tr>                        
						<td width="36%" align="right"> <b> Enter the Userid to be deleted: </b> </td>
						<td width="64%" align="left"> <input type="text" name="userid" /> </td>
					</tr>
			  </table>
			  <p><br />  
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;							
			    <input class="formbutton" type="submit" name="delete" value="Delete Account" />
			    <input class="formbutton" type="reset" value="Clear">
			  </p>
			  <p>&nbsp; </p>
        	</form>
        	<p>&nbsp;</p>
			<p>&nbsp;</p>
        </div>
     </div> 
	<div class="clear"></div>
    </div>
    
    <div id="footer">
        <div class="footer-content">
			<p><a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Terms_Condition.php"> Terms and Conditions </a>&nbsp;
            	<a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Help.php"> Help </a>&nbsp;               
				<a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Contacts.php"> Contact Us </a></p>
			<p><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; StudentJudicial Action: Design by Group 13 - Class B561 (Fall 2012) </p>
		</div>
    </div>
</div>
</body>
</html>