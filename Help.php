<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php session_start();
$inactive = 600;
	$UserName = $_SESSION["username"];
	$permission =$_SESSION["Permission"];
	if ($permission == 1)
		$UserName = $_SESSION["StudentName"];
//	if (!isset($_SESSION['views']))
//	{
//	 header("Location: http://www.cs.indiana.edu/cgi-pub/lnookala/index.php");
//	}
//	include "DBConnect.php";
	//$CaseID = 12;
	if(isset($_SESSION['timeout']) ) 
	{	$session_life = time() - $_SESSION['timeout'];	
	   if($session_life > $inactive)        
	   { session_destroy(); 
	     header("Location:  index.php"); 
		}
	}
	$_SESSION['timeout'] = time();
	$CaseID = $_SESSION["caseid"];

?>
<title>Help</title>
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
        <h3>Help&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Logout.php" ><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout"></a></h3>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo"$UserName";?></label></div>
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
        	
            
            
            <li><a href="User_Preferences.php">User Preferences</a></li>
            <li><a href="Contacts.php">Contact Us</a></li>
            
            <?php
if($_SESSION['PermDesc']=="Dean")
echo "<li><a href=\"AccountCreation.php\">Admins Console</a></li>"
?>

        </ul>
    </div>
    <div id="body" style="width: 930px; height: 900px">
	  <p>&nbsp;</p>
	  <div id="content" style="width: 900px; height: 847px">
      

<p><b>FAQ</b></p>
<ol>
	
	<li>How do I use this system? - You simply need to be a member of IU. Any student, staff or faculty can enter using their credentials.</li>
</ol>



<p><b>Student Judicial Action Facts</b></p>
<ol>
	<li>Every user who logs in with appropriate permissions will be able to search the students, cases and employees based on their permission levels and edit relevant details.</li>
	<li>When a student id is entered, the matching results should be displayed and on selecting the required student all the case history, i.e. all cases the student was involved in should be displayed.</li>
	
</ol>

<p><b>Technology</b></p>
<ol>

	<li>PHP</li>
	<li>MySQL</li>
	<li><a href="http://www.w3schools.com/php/default.asp">PHP Reference</a></li>
</ol>

<p><b>Privacy Policy</b></p>
<ol>
	<li>Our site does not collect personal information without your knowledge and consent. Personal information includes such things as your name, address, phone number, or other specific facts that identify you as an individual.</li>

<li>No personal information is sold or rented to any third parties.</li>
</ol>


        
    
            
        </div>
	  <div class="clear"></div>
  </div>

    <div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
			Contact Us </a></p>
			<p align="center"><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a> &copy; StudentJudicial Action: Design by Group 13: Class B561 (Fall 2012)</p>
		</div>
    </div>
</div>
</body>
</html>