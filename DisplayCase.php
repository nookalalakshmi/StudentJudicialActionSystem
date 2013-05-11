<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Display Case</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
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
include "DBConnect.php";
include "CaseStatus.php";
$UserName = $_SESSION["username"];
$Permission = $_SESSION["Permission"];
if($Permission == 1)
{
	$UserName = $_SESSION["StudentName"];
}

if(isset($_GET['caseid']))
{
	$_SESSION['caseid'] = $_GET['caseid'];
}
$caseid = $_SESSION['caseid'];

if(isset($_GET['edit']))
	$_POST['edit']=$_GET['edit'];
else if(isset($_POST['edit']))
	$_GET['edit']=$_POST['edit'];

$query = "select * from StudentCase where Caseid = $caseid;";
$result = mysql_query ($query);
$CaseStatus = mysql_result($result,0,"CaseStatus");
?>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.min.css">
<!--<style type="text/css">
			
			.calendar {
				font-family: 'Trebuchet MS', Tahoma, Verdana, Arial, sans-serif;
				font-size: 0.9em;
				background-color: #EEE;
				color: #333;
				border: 1px solid #DDD;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
				padding: 0.2em;
				width: 14em;
			}
			
			.calendar a {
				outline: none;
			}
			
			.calendar .months {
				background-color: #F6AF3A;
				border: 1px solid #E78F08;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
				color: #FFF;
				padding: 0.2em;
				text-align: center;
			}
			
			.calendar .prev-month,
			.calendar .next-month {
				padding: 0;
			}
			
			.calendar .prev-month {
				float: left;
			}
			
			.calendar .next-month {
				float: right;
			}
			
			.calendar .current-month {
				margin: 0 auto;
			}
			
			.calendar .months a {
				color: #FFF;
				text-decoration: none;
				padding: 0 0.4em;
				-moz-border-radius: 4px;
				-webkit-border-radius: 4px;
				border-radius: 4px;
			}
			
			.calendar .months a:hover {
				background-color: #FDF5CE;
				color: #C77405;
			}
			
			.calendar table {
				border-collapse: collapse;
				padding: 0;
				font-size: 0.8em;
				width: 100%;
			}
			
			.calendar th {
				text-align: center;
			}
			
			.calendar td {
				text-align: right;
				padding: 1px;
				width: 14.3%;
			}
			
			.calendar td a {
				display: block;
				color: #1C94C4;
				background-color: #F6F6F6;
				border: 1px solid #CCC;
				text-decoration: none;
				padding: 0.2em;
			}
			
			.calendar td a:hover {
				color: #C77405;
				background-color: #FDF5CE;
				border: 1px solid #FBCB09;
			}
			
			.calendar td.today a {
				background-color: #FFF0A5;
				border: 1px solid #FED22F;
				color: #363636;
			}
			
		</style> 
        <link type="text/css" href="jquery-ui-1.8.5.custom.css" rel="Stylesheet" />
<script type="text/javascript" src="datepickr.js"></script>
	</script>-->
	<script type="text/javascript">
		$(document).ready(function()
		{
			$("#ReferralDate").datepicker({dateFormat: 'mm-dd-yy'});
			$("#DateOcurred").datepicker({dateFormat: 'mm-dd-yy'});
			
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
			$('.autocompletevoilations').autocomplete(
			{
				source: "VoilationSearch4AutoComplete.php",
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
<script type="text/javascript">
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

function Appeal_Click()
{
	if(confirm("Do you Really want to appeal ? \n You will be asked for confirmation again."))
	{
		if(confirm("Are you sure you want to Appeal ? This can't be undone.")){
		window.location = "Appeal.php";
		}
	}
}

function selectAllOptions()
{
	
  var selObj = document.getElementsByName("NewStudents[]")[0];
  for (var i=0; i<selObj.options.length; i++)
  {
    selObj.options[i].selected = true;
  }
  
  var selObj = document.getElementsByName("NewVictims[]")[0];
  for (var i=0; i<selObj.options.length; i++)
  {
    selObj.options[i].selected = true;
  }
  
  var selObj = document.getElementsByName("NewVoilations[]")[0];
  for (var i=0; i<selObj.options.length; i++)
  {
    selObj.options[i].selected = true;
  }
}

function Save_onclick()
{
	if(document.getElementsByName("ReferralName")[0].value.length <=0)
	{
		window.alert("Referral Name can't be empty");
		return ;
	}
	
	if(document.getElementsByName("DateOcurred")[0].value.length <=0)
	{
		var d1 = Date(document.getElementsByName("DateOcurred")[0].value);
		window.alert("Incident date can't be empty");
		return ;
	}
	if(document.getElementsByName("ReferralDate")[0].value.length <=0)
	{
		window.alert("Referral date can't be empty");
		return ;
	}
		
	if(document.getElementsByName("Location")[0].value.length <=0)
	{
		window.alert("Location can't be empty");
		return ;
	}
	
if(document.getElementsByName("CaseDescription")[0].value.length <=0)
	{
		window.alert("Case Description can't be empty");
		return ;
	}	
	var today=new Date();
	var IncidentDate = new Date(document.getElementsByName("DateOcurred")[0].value);
	var ReferralDate = new Date(document.getElementsByName("ReferralDate")[0].value);
	
	if(IncidentDate > today)
	{
		window.alert("Incident date can't be after today");
		return ;
	}
	
	if(ReferralDate > today)
	{
		window.alert("Referral date can't be after today");
		return ;
	}
	
	if(IncidentDate > ReferralDate)
	{
		window.alert("Incident date can't be after Referral date");
		return ;
	}
	selectAllOptions();
	document.forms['DisplayCase'].action = "UpdateCase.php?edit=false";
	document.forms['DisplayCase'].submit();
}



function removeNewStudent()
{
  var elSel = document.getElementsByName("NewStudents[]")[0];
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
    if (elSel.options[i].selected) {
      elSel.remove(i);
    }
  }
}

function RemoveVoilation()
{
  var elSel = document.getElementsByName("NewVoilations[]")[0];
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
    if (elSel.options[i].selected) {
      elSel.remove(i);
    }
  }
}

function removeNewVictim()
{
  var elSel = document.getElementsByName("NewVictims[]")[0];
  var i;
  for (i = elSel.length - 1; i>=0; i--) {
    if (elSel.options[i].selected) {
      elSel.remove(i);
    }
  }
}

function addStudent()
{
  var Student = document.getElementsByName("AddStudentText")[0].value;
  if(Student == "" || Student == null)
  {
  	alert("Pick a valid student from the suggestion");
	return;
  }
  var id = Student.split(" / ")[1];
  var elOptNew = document.createElement('option');
  elOptNew.text = Student;
  elOptNew.value = id;
  var elSel = document.getElementsByName('NewStudents[]')[0];

  try {
    elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
  }
  catch(ex) {
    elSel.add(elOptNew); // IE only
  }
  document.getElementsByName("AddStudentText")[0].value="";
}

function addVoilation()
{
  var Voilation = document.getElementsByName("AddVoilationsText")[0].value;
  if(Voilation == "" || Voilation == null)
  {
  	alert("Pick a valid voilation from the suggestion");
	return;
  }
  var id = Voilation.split(" / ")[1];
  var elOptNew = document.createElement('option');
  elOptNew.text = Voilation;
  elOptNew.value = id;
  var elSel = document.getElementsByName('NewVoilations[]')[0];

  try {
    elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
  }
  catch(ex) {
    elSel.add(elOptNew); // IE only
  }
  document.getElementsByName("AddVoilationsText")[0].value="";
}

function addVictim()
{
  var Victim = document.getElementsByName("AddVictimText")[0].value;
  if(Victim == "" || Victim == null)
  {
  	alert("Pick a valid student from the suggestion");
	return;
  }
  var id = Victim.split(" / ")[1];
  var elOptNew = document.createElement('option');
  elOptNew.text = Victim;
  elOptNew.value = id;
  var elSel = document.getElementsByName('NewVictims[]')[0];

  try {
    elSel.add(elOptNew, null); // standards compliant; doesn't work in IE
  }
  catch(ex) {
    elSel.add(elOptNew); // IE only
  }
  document.getElementsByName("AddVictimText")[0].value="";
}

function Edit_onclick()
{

window.location = 
"DisplayCase.php?edit=true&caseid="+
<?php
	echo($caseid);
	?>;
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
    <style type="text/css">
        .style3
        {
        }
        .style4
        {
            width: 311px;
        }
    </style>
</head>

<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">

<div id="container">
	<div id="header">
    	<h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        																																																				</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        																																																				</h1>                             
         <h3>Display Case&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3> 
      <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo"$UserName";?></label></div>
     </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li><a href='<?php if($Permission!=1) echo"Home_Page.php"; else echo "StudentHome.php" ?>'>Home</a></li>
            <li><a href="DisplayCase.php?edit=false&caseid=<?php echo"$caseid"?>">Case Details</a></li>
            <?php echo '<li><a href="Display_Document_1.php">Documents</a></li>'; ?>
            <?php if($Permission!=1) echo '<li><a href="displayCOC.php">Code of Conducts</a></li>'; ?>
            <?php if($Permission!=1) echo '<li><a href="displaySanctions.php">Sanctions</a></li>';?>
            <?php echo '<li><a href="User_Preferences.php">User Preferences</a></li>';?>
            <?php if($Permission!=1 && $CaseStatus!=$StatusStringTOInt["APPEALED AND CLOSED"]) {echo '<li><a href=AddHearing.php?caseid=';echo $caseid;echo'>Add Hearing</a></li>';} ?>
        </ul>
  </div>
  <div id="body" style="width: 930px; height: 887px">
  <p align="right">&nbsp;</p>
      <div id="content" style="width: 900px; height: 847px">
          <form id="DisplayCase" name="DisplayCase" method="post" action="UpdateCase.php">
          <table border="0">
              <tr>
                  <td class="style4">
                      Case ID : 
			          <label><?php echo $caseid;?>
                      </label></td>
                  <td width="46%">
                      <div align="right">Incident Date :
  <input  id="DateOcurred" name="DateOcurred" value='<?php
					  echo(date('m-d-y',strtotime(mysql_result ($result, 0, "DateOcurred"))));
                      ?>' readonly="readonly" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?>/>
                        
                        
                </div></td>
              </tr>
              <tr>
                  <td align="right" class="style4">
                      Referral Name:
                      <input name="ReferralName" type="text" id="Text1" 
                          value='<?php
						  $ReferrerName = mysql_result ($result, 0, "Referrer");
					  echo(htmlentities($ReferrerName, ENT_QUOTES));
                      ?>' maxlength="30" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?> /></td>
                  <td align="right">
                      <div align="right">Referral Date :
  <input id="ReferralDate" name="ReferralDate" value='<?php
					  echo(date('m-d-y',strtotime(mysql_result ($result, 0, "DateReferred"))));
                      ?>' readonly="readonly" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?>/>
                        
                        
                      </div></td>
              </tr>
              <tr>
                  <td align="right" class="style4">
                      Location:
                      <input name="Location" type="text" id="Text3" value='<?php
					  echo(mysql_result ($result, 0, "Location"));
                      ?>' maxlength="45" 
                          <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?> /></td>
                  <td align="right">
                      Status:
                      <select id="Select1" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?> name="Status">
                          <?php
					  for($j=0;$j<sizeof($StatusIntTOString);$j++)
					  {
						  if($StatusIntTOString[$j]!=$StatusIntTOString[mysql_result ($result, 0, "CaseStatus")])
						  {
						  echo("<option>".$StatusIntTOString[$j]."</option>");
						  }
					  }
					  $CaseStatus = mysql_result ($result, 0, "CaseStatus");
					  echo("<option selected>".$StatusIntTOString[mysql_result ($result, 0, "CaseStatus")]."</option>");
					
                      ?>
                      </select></td>
              </tr>
              <tr>
                  <td>
                      Description:
                      <br />
                      <br />
                      <textarea id="TextArea1" name="CaseDescription" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?>><?php
					  echo(mysql_result ($result, 0, "CaseDescription"));
                      ?></textarea><br />
                      <br />
                  </td>
                  <td><table width="200" border="0">
                    <?php 
				  $query = "select S.Name Name from CaseVictims CV, Student S where CV.Studentid=S.Studentid and CV.Caseid=$caseid";
				  $result = mysql_query ($query);
				  $num = mysql_numrows ($result);
				  echo "<tr><th>Victims</th></tr>";
				  for ($i = 0; $i < $num; $i++) 
				{
					echo "<tr>";
					$VictimName = mysql_result ($result, $i, "Name");
					echo "<td>$VictimName</td>";
					echo "</tr>";
				}
				  ?>
                  </table>
                  
                  </td>
              </tr>
              <tr>
                  <td>
                      <p>Hearing Officer:
                        <select id="Select2" <?php if($_POST["edit"] == "false"){echo("disabled=\"disabled\"");} ?> name="HearingOfficer">
                          <?php
						  //List of all hearing officers
						  
$query1 = "select Name, Employeeid ID from Employee where Designationid=3";
$result = mysql_query ($query1);

$num = mysql_numrows ($result);


						  //Hearing officer who is handling this case
$query2 = "select Name,E.Employeeid empid from EmployeeHandlesCase EHC,Employee E where Caseid = $caseid and E.Employeeid = EHC.Employeeid;";
$ThisCaseHearingOfficer = mysql_query ($query2);
$_SESSION['HearingOfficerId']=mysql_result ($ThisCaseHearingOfficer, 0, "empid");
$_SESSION['OldHearingOfficerId']=mysql_result ($ThisCaseHearingOfficer, 0, "empid");
echo("<option selected>".mysql_result ($ThisCaseHearingOfficer, 0, "Name")." / ".mysql_result ($ThisCaseHearingOfficer, 0, "empid")."</option>");

for ($i = 0; $i < $num; $i++) 
{
	$ID = mysql_result ($result, $i, "ID");
	$Name = mysql_result ($result, $i, "Name");
	if($ID!=mysql_result ($ThisCaseHearingOfficer, 0, "empid"))
	{
		echo "<option>$Name / $ID</option>";
	}
}	
?>
                        </select>
                      </p>
                <td><p>Hearing Date: <?php $query =  "select Date from Appointment where DATE(Date)>=CURDATE() and Caseid=$caseid;";
$result = mysql_query($query);
if(mysql_num_rows($result) > 0)
{
echo date('m-d-y',strtotime(mysql_result($result,0,"Date")));
}
?></p></td><tr>
                <td colspan="2"><table width="200" border="1">
                  <tr>
                    <th colspan="3"><div align="center">History</div></th>
                  </tr>
                  <tr>
                    <th>Date</th>
                    <th>Notes</th>
                    <th>Status</th>
                  </tr>
                  <?php 
				  $query = "select Date, CaseNotes, CaseStatus from CaseHistory where Caseid=$caseid";
				  $result = mysql_query ($query);
				  $num = mysql_numrows ($result);
				  for ($i = 0; $i < $num; $i++) 
				{
					echo "<tr>";
					$Date = mysql_result ($result, $i, "Date");
					$CaseNotes = mysql_result ($result, $i, "CaseNotes");
					$Status = mysql_result ($result, $i, "CaseStatus");
					echo "<td>$Date</td><td>$CaseNotes</td><td>{$StatusIntTOString[$Status]}</td>";
					echo "</tr>";
				}
				  ?>
                  <?php
				  if($_POST['edit']=="true")
					  echo("
                  <tr>
				  <td colspan='1'>Enter Case Notes Here:</td>
                    <td colspan='2'><div align='center'>
                      <input name='CaseNotes' type='text' id='Text3' size='80' maxlength='200' />
                    </div></td></tr>
                      
			  ")
			  ?>
                </table>              
                <tr>
                <td colspan="2">
                    <p>
                        Students Involved:</p>
                     <p>
                       <?php
$query = "select CSS.Studentid ID, S.Name Name, CSS.Sanctionid sanid, San.Description Sanction from  CaseStudentSanction CSS, Student S, Sanctions San where CSS.Caseid=$caseid and CSS.Studentid=S.Studentid and CSS.Sanctionid=San.Sanctionid";
$result = mysql_query ($query);

$num = mysql_numrows ($result);

echo "<table border='0'><tr><th>Student ID</th><th>Student Name</th><th>Sanction</th></tr>";

for ($i = 0; $i < $num; $i++) {
	echo "<tr>";
	$ID = mysql_result ($result, $i, "ID");
	$Name = mysql_result ($result, $i, "Name");
	$Sanction = mysql_result ($result, $i, "Sanction");
	$Sanid = mysql_result ($result, $i, "sanid");
	echo "<td>$ID</td> <td>$Name</td>"; 
	echo("<td><select id=\"Select2\" name=$ID");
	if($_POST["edit"] == "false"){echo(" disabled=\"disabled\"");}
	echo(" name=\"San\">");
	echo("<option selected>$Sanction / $Sanid</option>");
	//Begin - Fetching Sanctions
	$query1 = "select * from Sanctions";
	$SanctionsList = mysql_query ($query1);
	$num1 = mysql_numrows ($SanctionsList);
	for ($j = 0; $j < $num1; $j++) 
	{
		$SanctionName = mysql_result ($SanctionsList, $j, "Description");
		$SanctionID = mysql_result ($SanctionsList, $j, "Sanctionid");
		if($Sanid!=$SanctionID)
		{
			echo("<option>$SanctionName / $SanctionID</option>");
		}
	}	
	//End - Fetching Sanctions
	echo("</select></td>");
	echo "</tr>";
}	

echo "</table>";
?>
                    </p></td>
                    </tr>
                      <?php if($_POST["edit"] != "false") echo'
              <tr>
                <td><p>Add Student(s): <span class="style4">
                  <input name="AddStudentText" type="text" class="autocompletestudent" maxlength="30" 
                          />
                </span><span class="style3">
                <input class="formbutton" 
                           name="AddStudentButton" type="button" onclick="addStudent()" id="Button2" value="Add"/>
                </span></p>
                <p>
                  <select name="NewStudents[]" size="1" multiple="multiple" id="select">
                  </select>
                  <span class="style3">
                  <input class="formbutton" 
                           name="RemoveStudent" type="button" id="Button3" value="Remove" onclick="removeNewStudent()"/>
                </span></p></td>
                <td><p>Add Victims(s): <span class="style4">
                  <input name="AddVictimText" type="text" class="autocompletestudent" maxlength="30" 
                          />
                </span><span class="style3">
                <input class="formbutton" 
                           name="AddVictimsButton" type="button" id="Button2" value="Add" onclick="addVictim()"/>
                </span></p>
                <p>
                  <select name="NewVictims[]" size="1" multiple="multiple" id="select">
                  </select>
                  <span class="style3">
                  <input class="formbutton" 
                           name="RemoveVictims" type="button" id="Button4" value="Remove" onclick="removeNewVictim()"/>
                </span></p></td>
              </tr>'
			  ?>
                      <tr>
                      <td colspan="2"><p>Voilations:</p>
                      <?php
$query = "select CVC.Codeid ID, CC.Description Code, CC.Category Category from CodeofConduct CC, CaseVoilatesCode CVC where CVC.Caseid=$caseid and CVC.Codeid=CC.Codeid";
$result = mysql_query ($query);

$num = mysql_numrows ($result);

echo "<table border='0'><tr><th>Code ID</th><th>Code of Conduct</th><th>Category</th></tr>";

for ($i = 0; $i < $num; $i++) {
	echo "<tr>";
	$ID = mysql_result ($result, $i, "ID");
	$Code = mysql_result ($result, $i, "Code");
	$Category = mysql_result ($result, $i, "Category");
	echo "<td>$ID</td> <td>$Code</td> <td>$Category</td>";
	echo "</tr>";
}	

echo "</table>";
?></td>
              </tr>
              <?php if($_POST["edit"] != "false") echo'
                      <tr>
                        <td colspan="2">Add Voilation(s) :<span class="style4">
                        <input name="AddVoilationsText" type="text" id="Text2" maxlength="30" 
                           class="autocompletevoilations"/>
                        </span><span class="style3">
                <input class="formbutton" 
                           name="AddVoilationsButton" type="button" id="Button2" value="Add" onclick="addVoilation()"/> 
                        </span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="NewVoilations[]" size="1" multiple="multiple" id="select">
                </select>
                  <span class="style3">
                  <input class="formbutton"
                           name="RemoveVoilations" type="button" id="Button3" value="Remove" onclick="RemoveVoilation()"/>
                  </span></td>
				  '?>
                      </tr>
              <tr>
                  <td align="center" class="style3" colspan="2">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <?php if($Permission!=1) {
						 echo'<input class="formbutton"
                           name="Edit" type="button" id="Button1"';  if($_POST["edit"] == "false")
						   { 
							   echo"value='Edit'"; 
							   echo "onclick='return Edit_onclick()'";
						   } else { echo 'value="Save" onclick="return Save_onclick()"';}  echo '/>'; } ?>
                           
                           <?php if($Permission==1 && $StatusIntTOString[$CaseStatus] == "CLOSED") {
						 echo'<input class="formbutton"
                           name="Appeal" type="button" id="Appeal"';  
							   echo"value='Appeal'"; 
							   echo "onclick='return Appeal_Click()'";
						        echo '/>'; } ?>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		              </td>
              </tr>
          </table>
          <p>
              <a href="#" align="right"></a>
          </p>
          </form>
      
  </div></div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
     <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
     <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <div align="left"><div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
			Contact Us </a></p>
			<p align="center"><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; Student Judiciary System 2012. Design by Indiana University Copyrights</p>
		</div>
    </div>
</div></div>
</body>
</html>
