<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reset Password</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
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

function validate()
{
	if(document.getElementById("name").value.length<=0)
	{
		alert("UserId field cannot be empty");
		return;
	}
	document.forms['ResetPwd'].action ="Forgot_Password.php";      
   
   document.form['ResetPwd'].submit();
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

// -->
</script>
</head>
<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    	<h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
        <h3>Reset Pasword &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Logout.php" ><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout"></a></h3>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php session_start();
		echo "{$_SESSION['username']}"; ?></label></div>
    </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<?php
			if($permission==1)
				{
					//echo "<a href=\"StudentHome.php\">Home</a>";
					echo "<li><a href=\"StudentHome.php\">Home</a></li>";
				}else
				{
					//echo "<a href=\"Home_Page.php\">Home</a>";
					echo "<li><a href=\"Home_Page.php\">Home</a></li>";
				}
				?>
            

        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
	  <p>&nbsp;</p>
	  <div id="content" style="width: 900px; height: 847px">
        
    <h2>&nbsp;</h2>
			<h2>Reset Password</h2><table width="400" border="0" align="center" cellpadding="3" cellspacing="1">
		  <tr>
<td><strong>Forgot Password Form </strong></td>
</tr>
</table>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td><form name="ResetPwd" method="post" onSubmit="return validate()">
<?php
// set timeout period in seconds
$inactive = 600;
// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        { session_destroy(); header("Location: index.php"); }
}
$_SESSION['timeout'] = time();
if(!isset($_SESSION['views']))
{
	header("Location: index.php");
}
include "DBConnect.php";

if($_POST['Userid']!="")
{
	$Userid=$_POST['Userid'];
	$res = mysql_query("update LoginInfo set Password='abcabc' where Userid='$Userid'");
	
	$res2 = mysql_query("select count(*) count from LoginInfo where Userid='$Userid'");
	if(mysql_result($res2,0,"count") == 1)
		echo('<p>Password successfully reset</p>');
	else 
		echo("<p>UserId does not exist $Userid</p>");
}

?>
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<td>UserId</td>
<td>:</td>
<td><input name="Userid" type="text" id="name" size="50"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input class="formbutton" type="submit" name="Submit2" value="Reset"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
			<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
<h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
<p>&nbsp;</p>
            
        </div>
	  <div class="clear"></div>
  </div>

    <div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
			Contact Us </a></p>
			<p>&copy; Student Judiciary System 2012. Design by Indiana 
			University Copyrights</p>
		</div>
    </div>
</div>
</body>
</html>