<?php 
session_start();
 
if(!isset($_SESSION['views']))
{
	header("Location: index.php");
}
else if($_SESSION['password']=="abcabc")
{
	$_SESSION['Defaultpwd']=1;
	header("Location: User_Preferences.php");
}


// inactive for 60 seconds
$inactive = 600; 
//$_SESSION['timeout']=time();
if(isset($_SESSION['timeout']))
{
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
	{  session_destroy(); header("Location: index.php");     }
}
$_SESSION['timeout']=time();
			  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Page</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.min.css">

<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script>
$(function() {
        $( "#txtStuBDate" ).datepicker({ minDate: new Date(1950,1-1,1), maxDate: 0 });
		
    });
</script>
<script language="JavaScript">
<!--
  
function enableStudent(obj)
{
var en1=document.getElementById("rbStudent").value;
		 
     if(en1=="rbStudent")
     {
		 document.getElementById("txtCaseID").value="";
         document.getElementById("txtCaseCoC").value="";
		 
	 	 document.getElementById("txtStudFname").value="";
		 document.getElementById("Gender").value="";
		 document.getElementById("txtStudID").value="";
		 document.getElementById("txtStuBDate").value="";
		 
		 document.getElementById("txtCaseID").disabled=true;
         document.getElementById("txtCaseCoC").disabled=true;
		 
	 	 document.getElementById("txtStudFname").disabled=false;
		 document.getElementById("Gender").disabled=false;
		 document.getElementById("txtStudID").disabled=false;
		 document.getElementById("txtStuBDate").disabled=false;
	 }
	 

}

function enableCase(obj)
{
var en1=document.getElementById("rbCase").value;
   
     if(en1=="rbCase")
     {
		 document.getElementById("txtCaseID").value="";
         document.getElementById("txtCaseCoC").value="";
		 
	 	 document.getElementById("txtStudFname").value="";
		 document.getElementById("Gender").value="";
		 document.getElementById("txtStudID").value="";
		 document.getElementById("txtStuBDate").value="";
		 
		 document.getElementById("txtCaseCoC").disabled=false;
		 document.getElementById("txtCaseID").disabled=false;
		 
         document.getElementById("txtStudFname").disabled=true;
		 document.getElementById("Gender").disabled=true;
		 document.getElementById("txtStudID").disabled=true;

		 document.getElementById("txtStuBDate").disabled=true;
		 
		 
     }

}

function validate()
{
var caseid = document.getElementById("txtCaseID").value;
   
var caseCoC = document.getElementById("txtCaseCoC").value;
		 
var SName = document.getElementById("txtStudFname").value;
var Gender = document.getElementById("Gender").value;
var SID = document.getElementById("txtStudID").value;

var BDate = document.getElementById("txtStuBDate").value;

var en1=document.getElementById("rbCase").value;
var en2=document.getElementById("rbStudent").value;
   
if(SName=="" && Gender=='0' && SID=="" && BDate=="")
	{
		alert("Please select at least one Search Criteria"); 
	}
else if(caseid=="" && caseCoC=="")
	{
		alert("Please select at least one Search Criteria"); 
	}

}
 
 
// -->
</script>
</head>

<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    <h1>Student Judicial Action      </h1>
    <h3>Home Page&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="http://www.cs.indiana.edu/cgi-pub/shrukest/Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3>
        <div class="clear">
          <p>Welcome, 
            <label accesskey="lblUser" class="clear">
              <?php echo $_SESSION['username'];?>
            </label>
          </p>
      </div>
  </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li><a href="Home_Page.php">Home</a></li>
            <li><a href="AddCase.php">New Case</a></li>
            <li><a href="displayCOC.php">Code Of Conduct</a></li>
            <li><a href="displaySanctions.php">Sanctions</a></li>
            <li><a href="User_Preferences.php">User Preferences</a></li>
            <li><a href="Contacts.php">Contact Us</a></li>
            
            <?php
			if($_SESSION['Permission']==4)
						echo "<li><a href=\"AccountCreation.php\">Admins Console</a></li>"
						?>
 <?php
			if($_SESSION['Permission']==2)
						echo "<li><a href=\"Forgot_Password.php\">Reset Password</a></li>"
						?>

        </ul>
    </div>
    <div id="body" style="width: 950px; height: 1000px">
		<form action="<?php $_SERVER['Home_Page.php']?>" method="post" onsubmit="validate()">
        <div id="content" style="width: 930px; height: 1000px">
			<h2>Search</h2>
			<p>
			  <input type="radio" name="selectSearch" id="rbStudent" value="rbStudent" 
			  <?php echo (!$_SESSION['selectSearch'] || $_SESSION['selectSearch'] == "rbStudent") ? 'checked="checked"' : '';
			  
			  ?> onclick="enableStudent(this.checked)" />&nbsp;
			  <label for="rbStudent">Student</label>
			&nbsp;
			<input type="radio" name="selectSearch" id="rbCase" value="rbCase" onclick="enableCase(this.checked)"/>&nbsp;
			<label for="rbCase">Case</label>
			</p>
			<fieldset><legend>Search</legend>
            <table width="92%" border="0" cellspacing="10" cellpadding="10">
  <tr>
    <td width="50%" align="left" valign="middle"><label for="txtStudID">Student ID</label>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="txtStudID" id="txtStudID" /></td>
    <td width="50%"align="right" valign="middle"><label for="txtStudFname">Student Name</label>&nbsp;&nbsp;
      <input type="text" name="txtStudFname" id="txtStudFname" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><label for="Gender">Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <select name="Gender" id="Gender">
        <option value="0">---Select Gender---</option>
        <option value="M">Male</option>
        <option value="F">Female</option>
      </select></td>
    <td align="right" valign="middle"><label for="txtStudBDate">Birthdate</label>&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="txtStudBDate" id="txtStuBDate" /></td>
  </tr>
  <tr>
    <td align="left" valign="middle"><label for="txtCaseID">Case ID</label>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="txtCaseID" id="txtCaseID" disabled="disabled"/></td>
    <td align="right" valign="middle"><label for="txtCaseCoC">Violation</label>
      &nbsp;&nbsp;
      <input type="text" name="txtCaseCoC" id="txtCaseCoC" disabled="disabled"/></td>
  </tr>
  <tr>
    <td align="right" valign="middle">
    <input type="Submit" name="btSearch" id="btSearch" value="Search" class="formbutton"/></td>
    <td><input type="reset" name="btClear" id="btClear" value="Clear" class="formbutton"/></td>
  </tr>
</table>
            <?php

	  include "DbConnect.php";

echo "<fieldset><legend>Search Results</legend><br/><table width=\"200\" border=\"0\" cellspacing=\"10\" cellpadding=\"10\">";
		
if($_POST['selectSearch']=='rbStudent')
{
	
	$queryconst = "Select Distinct s.Studentid, s.Name, sc. Caseid, sc.CaseDescription from Student s, StudentCase sc,CaseStudentSanction css, CaseVoilatesCode cvc where s.Studentid=css.Studentid and css.Caseid=sc.Caseid and cvc.Caseid=css.Caseid";
	
	if($_POST['txtStudID']!="")
		{
			$StuID = $_POST['txtStudID'];
			$queryconst = $queryconst." and s.Studentid = $StuID";
		}
	if($_POST['txtStudFname']!="")
		{
			$Name = $_POST['txtStudFname'];
			$queryconst = $queryconst." and s.Name LIKE '%$Name%'";
			
		}
	if($_POST['txtStuBDate']!="")
		{
			$BDay = $_POST['txtStuBDate'];
			$queryconst = $queryconst." and s.Birthdate = '$BDay'";
			
		}
	if($_POST['Gender'])
		{
			$Gender = $_POST['Gender'];
			$queryconst = $queryconst." and s.Sex = '$Gender'";			
		}
		
if($_POST['txtCaseCoC']!="" || $_POST['txtCaseID']!="" || $_POST['Gender']=='M' || $_POST['Gender']=='F' || $_POST['txtStuBDate']!="" || $_POST['txtStudFname']!="" ||$_POST['txtStudID']!=""){
$result = mysql_query($queryconst)  or die;
$rows = mysql_num_rows($result);

}
else
{
	unset($result);
}

echo "<tr><td>Student ID</td><td>Student Name</td><td>Case ID</td><td>Case Description</td></tr>";
$count=0;
while ($row=mysql_fetch_array($result)) {
	echo "<tr><td>".$row[0]."</td>
	<td>".$row[1]."</td>
		<td><a href=\"DisplayCase.php?edit=false&caseid=$row[2]\">".$row[2]."</td>
		<td>".$row[3]."</td>";
		
} 
echo "</table></fieldset><br/>";
	unset($result);
}


if($_POST['selectSearch']=='rbCase')
{
	$queryconst="Select Distinct sc. Caseid, sc.CaseDescription, sc.DateOcurred from StudentCase sc, CaseVoilatesCode cvc where sc.Caseid=cvc.Caseid";
			
	if($_POST['txtCaseID']!="")
		{
			$CaseID = $_POST['txtCaseID'];
			$queryconst = $queryconst." and sc.Caseid = $CaseID";
		}
	if($_POST['txtCaseCoC']!="")
		{
			$CaseCoC = $_POST['txtCaseCoC'];
			$queryconst = $queryconst." and cvc.Codeid IN  (Select Codeid from CodeofConduct where Description LIKE '%$CaseCoC%')";
		}

if($_POST['txtCaseCoC']!="" || $_POST['txtCaseID']!="" || $_POST['Gender']=='M' || $_POST['Gender']=='F' || $_POST['txtStuBDate']!="" || $_POST['txtStudFname']!="" ||$_POST['txtStudID']!="")
{
$result = mysql_query($queryconst)  or die;
$rows = mysql_num_rows($result);

}
else
{
	unset($result);
}

echo "<tr><td>Case ID</td><td>Case Description</td><td>Date Occurred</td></tr>";

while ($row=mysql_fetch_array($result)) {
	echo "<tr><td><a href=\"DisplayCase.php?edit=false&caseid=$row[0]\">".$row[0]."</td>
		<td>".$row[1]."</td>
		<td>".$row[2]."</td>";
		
} 
echo "</table></fieldset><br/>";
	unset($result);
}

	unset($_POST); 
?>
          </fieldset>        	
	    </div>
	  </form>
    	<div class="clear"></div>
    </div>
    <div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
			Contact Us </a></p>
			<p><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; Student Judiciary System 2012. Design by Indiana 
			University Copyrights</p>
		</div>
    </div>
</div>
</body>
</html>
