<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Home</title>
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
<?php session_start();
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
else if($_SESSION['password']=="abcabc")
{
	$_SESSION['Defaultpwd']=1;
	header("Location: User_Preferences.php");
}
include "DBConnect.php";
include "CaseStatus.php";

$UserID = $_SESSION['username'];
$_SESSION["Permission"]=1;
$Permission=1;
$query = "SELECT Name from Student where Studentid=$UserID";
$result = mysql_query ($query);
$StudentName = mysql_result ($result, 0, "Name");
$_SESSION["StudentName"] = $StudentName;

$query = "select CSS.Caseid caseid, SC.CaseDescription description, SC.CaseStatus status from StudentCase SC, CaseStudentSanction CSS where  CSS.Studentid = $UserID and CSS.Caseid = SC.Caseid;";

$result = mysql_query ($query);
?>
<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">

<div id="container">
	<div id="header">
    	<h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
        <h3>Home Page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo"$StudentName";?></label></div>
    </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li><a href='<?php if($Permission!=1) {echo"Home_Page.php";} else {echo "StudentHome.php";} ?>'>Home</a></li>
            <?php echo '<li><a href="User_Preferences.php">User Preferences</a></li>';?>
            
            <!--<li><a href="http://www.cs.indiana.edu/cgi-pub/pgprakas/DisplayCase.php?edit=false&caseid=">Case Details</a></li>
            <li><a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Display_Document_1.php">Documents</a></li>
            <li><a href="http://www.cs.indiana.edu/cgi-pub/yitpeng/displayCOC.php">Code of Conducts</a></li>
            <li><a href="http://www.cs.indiana.edu/cgi-pub/yitpeng/displaySanctions.php">Sanctions</a></li>
            <li><a href="User_Preferences.html">User Preferences</a></li>
            <li><a href="Admin_Console.html">Admin Console</a></li> -->
        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
		<div id="content" style="width: 900px; height: 847px">
			<h2>Case Listings: </h2>
			<p>*click on a caseid to view complete details.</p>
            <table width="200" border="1">
              <tr>
                <th scope="col"><div align="center">CaseID</div></th>
                <th scope="col"><div align="center">Description</div></th>
                <th scope="col"><div align="center">Status</div></th>
              </tr>
              <?php 
				  $num = mysql_numrows ($result);
				  for ($i = 0; $i < $num; $i++) 
				{
					echo "<tr>";
					$caseid = mysql_result ($result, $i, "caseid");
					$desc = mysql_result ($result, $i, "description");
					$status = mysql_result ($result, $i, "status");
					echo "<td><a href='DisplayCase.php?caseid=$caseid&edit=false'>$caseid</a></td><td>$desc</td><td>{$StatusIntTOString[$status]}</td>";
					echo "</tr>";
				}
				  ?>
            </table>
            <p>&nbsp;</p>
			<p>&nbsp;</p>
            
        </div>
        
        
    	<div class="clear"></div>
    </div>

    <div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
			Contact Us </a></p>
			<p align="center"><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; Student Judiciary System 2012. Design by Indiana University Copyrights</p>
		</div>
    </div>
</div>
</body>
</html>
