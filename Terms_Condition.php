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
<title>Terms and Conditions</title>
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
        <h3>Terms and Conditons&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Logout.php" ><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout"></a></h3>
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
    <div id="body" style="width: 930px; height: 1351px">
	  <p>&nbsp;</p>
	  <div id="content" style="width: 900px; height: 847px">
      

<p>Thank you for visiting this web site located at: <a href="index.php" title="www.php.com">Student Judiciary System</a> (“Site”).</p>
<p><b>Privacy Policy: We Don't Collect Personal Information without Your Knowledge and Consent </b></p>
<p>Our site does not collect personal information without your knowledge and consent. Personal information includes such things as your name, address, phone number, or other specific facts that identify you as an individual.</p>
<p>No personal information is sold or rented to any third parties.</p>
<p><b>What we collect and how we use it.</b> Generally, you may visit this site without providing us with any personally identifiable information. However, in certain sections of this site, we may invite you to submit questions or comments and request information. Due to the nature of these activities, we may ask that you complete and submit an online form with personally identifiable information such as your name, address, phone number, email address, username, and password. When you provide such information to us, we use it to: deliver requested information; allow you to access your specific account information; and to improve the content and general administration of the site.</p>
<p><b>Cookies.</b> To improve your experience and administration of the site, we may use “cookies” when you are logged into the site using your e-mail address and/or password. A cookie is a piece of data that is transferred to your browser by a Web server and can only be understood by the server that gave it to you. It functions as your computer’s identification token and enables us to personalize your experience when you are signed in to the site. The cookie also contains your e-mail address so that we can make it easier for you to sign in. If you reject the cookie, you may not be able to sign up for some of the services or use certain features of the site.</p>
<p>Most browsers are initially set to accept cookies. You can set your browser to notify you when you receive a cookie, giving you the chance to decide whether to accept it. (For some Web pages that require an authorization, cookies are not optional. Users choosing not to accept cookies will probably not be able to access those pages.)</p>
<p>While the site may use cookies to enable you to use certain services and the site, We don't use this information to identify you personally except to provide you with the features of the site.</p>
<p><b>Disclosure.</b> We will disclose your personally identifiable information if we reasonably believe we are required to do so by law, regulation or other government authority or to prevent harm to yourself or others.</p>
<p><b>Links to Third Party sites.</b> This site may be linked to other websites on the Internet which are not under the control of or maintained by Us (“Third Party Sites”). Such links do not constitute an endorsement by Us of these Third Party Sites, the content displayed therein, or the persons or entities associated therewith. You acknowledge that we are providing these links to you only as a convenience, and you agree that we are not responsible for the content of such Third Party Sites. Your use of these Third Party Sites is subject to the respective terms of use and privacy policies located on the Third Party Sites.</p>
<p><b>Security.</b> The site may employ procedural and technological measures, consistent with the demands of customer service. Such measures are reasonably designed to protect your personally identifiable information from loss, unauthorized access, disclosure, alteration or destruction. The site may use encryption, password protection, firewalls, internal restrictions and other security measures to help prevent unauthorized access to your personally identifiable information.</p>
<p><b>Correction, Updating and Deleting Personally Identifiable Information.</b> This site provides you with the ability to review, correct and delete any of the personally identifiable information that we have received from you. If you wish to review, correct or delete any of your personally identifiable information you may do so by editing your account information or contacting us.</p>
<p>If you have questions or comments regarding our privacy practices you can contact us at: <a href="mailto:akshgupt@indiana.edu">akshgupt@indiana.edu</a>. We will be sure to address your concerns.</p>
<p>This Privacy Policy was last updated: November 2012</p>
<p>This Privacy Policy is effective as of: November 2012</p>
<p> Terms and Conditions referenced from <a href="http://www.php.com/conditions">http://www.php.com/conditions</a> </p>
        
    
            
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