<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Preferences</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
</head>

<?php session_start();
include "DBConnect.php";

if(!isset($_SESSION['views']))
{
	header('Location: index.php');
}

$username = $_SESSION['username'];
$perm = $_SESSION['Permission'];
$default_pwd = $_SESSION['Defaultpwd'];

if($perm == 1)
	$student = $_SESSION['StudentName'];

$result = mysql_query ("select password from LoginInfo where userid = '$username';");
$current_pwd = mysql_result($result,0,"Password");

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

function ValidateForm(obj)
{
	var x=document.forms["form1"]["oldpwd"].value;
	var y=document.forms["form1"]["newpwd"].value;
	var z=document.forms["form1"]["retypepwd"].value;
	var pwd='<?php echo $current_pwd; ?>';
	
	if (x==null || x=="" || y==null ||y=="" || z==null || z=="")
	{
		alert("Password cannot be an empty string");
		return false;
	}	
	
	if(x != pwd)
	{
		alert("Current password dosen't match");
		document.forms["form1"]["oldpwd"].focus();
		return false;
	}
	
	if (document.forms["form1"]["newpwd"].value.length < 6)
	{
		alert("Password must contain at least six characters");
		document.forms["form1"]["newpwd"].focus();
		return false;
	}
	
	re = /[0-9]/;
	if(!re.test(y)) 
	{
		alert("Password must contain at least one number (0-9)!");
		document.forms["form1"]["newpwd"].focus();
		return false;
	}
	
	re = /[a-zA-Z]/;
	if(!re.test(y)) 
	{		
		alert("Password must contain at least one alphabet!");
		document.forms["form1"]["newpwd"].focus();
		return false;
	}
	
	if(y == x)
	{
		alert("New Password is equal to the Old Password ");
		document.forms["form1"]["newpwd"].focus();		
		return false;
	}
	
	if(y != z)
	{
		alert("Mismatch in password and retype password");
		return false;
	}
}

// -->
</script>
</head>

<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    <h1>Student Judicial Action      </h1>
    <h3>Change Password <a style="float:right;margin-right:15%;" href ="http://www.cs.indiana.edu/cgi-pub/shrukest/Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3>
        <div class="clear">
          <p>Welcome, 
            <label accesskey="lblUser" class="clear">
              <?php 
				if($perm == 1)
				{
					echo $student;
				}
				else
				{
					echo $_SESSION['username'];
				}
			  ?>
            </label>
          </p>
      </div>
  </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
			<?php if(!$_SESSION['Defaultpwd'])
			{?>
				<li> <a href="<?php if($perm == 1)
						{
							echo "StudentHome.php";
						}
						else
						{
							echo "Home_Page.php";
						} ?>">Home</a>
				</li>
			<?php } ?>
        </ul>
    </div>

    <div id="body">
    
		<?php
		
        $password = $_POST['retypepwd'];
        
		if(isset($_POST['submit']))
		{
			$query = "UPDATE LoginInfo SET Password='$password' WHERE Userid='$username';";
			$result = mysql_query ($query);						
			
			if ($result)
			{
				if(isset($_SESSION['Defaultpwd']))
				{
					unset($_SESSION['Defaultpwd']);
				}
				
				if(isset($_SESSION['password']))
				{
					unset($_SESSION['password']);
				}
				
				if($perm == 1)
				{
					header("Location:StudentHome.php");
				}
				else
				{
					header("Location:Home_Page.php");
				}
			}
			else
			{
				echo"<p> Password not changed </p>";
			}
		}
        ?>
        
		<div id="content" style="width: 930px; height: 600px">
        	<form id="form1" method="post" action="<?php $_SERVER['User_preferences.php']?>">
            	<br /> <br /> <br /> <br />
                Password Rules: The password must be atleast 6 characters and must contain atleast one alphabet and one digit.
                <br /> <br />
              	<table border="1">
					<tr>                        
						<td align="right"> <b> Enter Current Password: </b> </td>
						<td align="left"> <input name="oldpwd" type="password" size="36" maxlength="20"> </td>
					</tr>
                    
                    <tr>
						<td align="right"> <b> Enter New Password: </b> </td>
						<td align="left"> <input name="newpwd" type="password" size="36" maxlength="20"> </td>
					</tr>
                    
                    <tr>
						<td align="right"> <b> Re-enter New Password: </b> </td>
						<td align="left"> <input name="retypepwd" type="password" size="36" maxlength="20"> </td>
                    </tr>
                    
                    <tr>
                    	<td align="right"> <input class="formbutton" name="submit" type="submit" value="SUBMIT" onclick="return ValidateForm(this)"> </td>
                        <td align="left"> <input class="formbutton" type="reset" value="RESET"> </td>
					</tr>
				</table>
			</form>
            
			<p>&nbsp;</p>
			<p>&nbsp;</p>
        </div>
     </div> 
	<div class="clear"></div>
    </div>
    
    <div id="footer">
        <div class="footer-content">
			<p><a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Terms_Condition.php">Terms and Conditions</a>&nbsp;
            	<a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Help.php"> Help </a>&nbsp;
				<a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Contacts.php"> Contact Us </a></p>
			<p><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; StudentJudicial Action: Design by Group 13 - Class B561 (Fall 2012) </p>
		</div>
    </div>
</div>
</body>
</html>