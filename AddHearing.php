<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.js"></script>
<script type="text/javascript" src="jquery-ui-1.9.1.custom/js/jquery-ui-1.9.1.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.9.1.custom/css/smoothness/jquery-ui-1.9.1.custom.min.css">
<style>
        /*.ui-autocomplete-loading {*/
        /*background: white url('images/loading.gif') right center no-repeat;*/
        /*}*/
    .ui-autocomplete {
        max-height: 70px;
        overflow-y: auto;
        width: 100px;
        border:1px solid #DDDDDD;
        filter: alpha(opacity=1);
        opacity: 1;

        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
</style>
    <?php 
	session_start();

    if(!isset($_SESSION['views']))
    {
        header("Location: index.php");
    }
	$Permission = $_SESSION["Permission"];
	$UserName = $_SESSION["username"];
	if($Permission == 1)
	{
		$UserName = $_SESSION["StudentName"];
	}
	if($Permission==1)
	{
		header("Location: StudentHome.php");
	}
    //For Timeout
    // set timeout period in seconds
    $inactive = 600;
    // check to see if $_SESSION['timeout'] is set
    if(isset($_SESSION['timeout']) ) {
    $session_life = time() - $_SESSION['timeout'];
    if($session_life > $inactive)
    { session_destroy(); header("Location: index.php"); }
    }
    $_SESSION['timeout'] = time();

//    $caseid = $_GET["caseid"];
//    $_SESSION['caseid']=$caseid;
//
//    if(isset($_GET['edit']))
//        $_POST['edit']=$_GET['edit'];
//    else if(isset($_POST['edit']))
//    {
//        $_GET['edit']=$_POST['edit'];
//        $query = "select  * from appointment where Caseid = $caseid;";
//        $result = mysql_query ($query);
//    }
?>
<script>
var studentNameList = new Array();
//var formLoad = true;
var studentList,victimBox, victimList,selectedVictimId, codeBox, codeList,selectedCodeId,studentBox,studentList,selectedStudentId;
function getURLParameter(name) {
    return decodeURI(
            (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}



$(document).ready(function () {

    $("#dateHearing").datepicker({
        onSelect:function(date)
        {
            
            //$("#slots").empty();
            var caseid = getURLParameter("caseid");
			//alert(caseid);
            getSlots(caseid);
        }, minDate: "-3M", maxDate: "+3M"
    });


   });


function getSlots(val)
{
    var dateValue = document.getElementById('dateHearing');
    //var emp = document.getElementById('employee').value;
    if (dateValue.value == null || dateValue.value=='')
    {
        alert("Please select a date for the hearing.");
        return;
    }

    if(val==''||val==null)
    {
        $("#slots").empty();
        return;
    }
	
	
    $.post("processHearing.php", { requestType:"searchSlot",caseid: val, hearingDate: dateValue.value},
    function(data) {
                //console.log(data);
				//alert(data);
                var res = jQuery.parseJSON(data);
                //alert("Response: " + res);
                $("#slots").empty();
                if(res[0]==false)
                {
                    $('#slots') 
                            .append($("<option></option>")
                            .attr("value",1)
                            .text("10am to 12pm"));
                }
                if(res[1]==false)
                {
                    $('#slots')
                            .append($("<option></option>")
                            .attr("value",2)
                            .text("1pm to 3pm"));
                }
                if(res[2]==false)
                {
                    $('#slots')
                            .append($("<option></option>")
                            .attr("value",3)
                            .text("3pm to 5pm"));
                }

            });
}

function removeHearing()
{
	var caseId = getURLParameter("caseid");
	var res = confirm("Are you sure?");
	
	if(res)
	{
		$.post("processHearing.php", { requestType:"removeHearing",caseid: caseId},
		function(data)
		{
			alert(data);
			$('#previousHearing').hide();
		});
	}
}

function validate()
{
    var validData = false;
    var hearingDate = document.getElementById('dateHearing').value;
    //var employeeSelected = document.getElementById('emp').value;
    var slotSelected = document.getElementById('slots').value;
    //alert(slotSelected);


    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = mm+'/'+dd+'/'+yyyy;


    if(hearingDate =='' || hearingDate ==null)
    {
        alert('Please select a date for the hearing.');
        //hearingDate.focus();
		$("#slots").empty();
        return validData;
    }

    if(slotSelected==''||slotSelected==null)
    {
        alert('No free slots available. Please change the Hearing Officer from the Case Details Page or select a different hearing date.');
        return validData;
    }
    validData = true;
    return validData;
}

function checkHearing()
{
	//alert('checking');
	var caseId = getURLParameter("caseid");
	
	$.post("processHearing.php", {requestType:"checkHearing",caseid: caseId},
	function(data)
	{
		if(data!=null && data!='')
		{
			alert(data);
			return;
		}else
		{
			validateSubmit();
		}
		
	});
	
	
}
function validateSubmit()
{
	var validationResult;
		
    validationResult = validate();

    if(validationResult)
    {
        $('#caseIdPost').val(document.getElementById('caseIdVal').value);
        //alert(document.getElementById('caseIdVal').value);
        document.forms["addHearingForm"].submit();
    }else return;

}

function returnToCase()
{
	var res = confirm("Are you sure?");
	var caseId = getURLParameter("caseid");
	if(res)
		window.open("DisplayCase.php?edit=false&caseid="+caseId,"_parent");
}

function returnToCaseFromLink()
{
	//var res = confirm("Are you sure?");
	var caseId = getURLParameter("caseid");
	//if(res)
		window.open("DisplayCase.php?edit=false&caseid="+caseId,"_parent");
}


</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Hearing - Student Judicial Action</title>
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
        <h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="Logout.php" style="float:right;margin-right:15%;"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout"></a>
        <h3>Add Hearing</h3>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo $UserName?></label></div>
    </div>
    <div id="nav" style="width: 960px; height: 70px">
        <ul>
            <li><a href="Home_Page.php">Home</a></li>
            <li></li>
            <li></li>
            <li><a href="" onclick="returnToCaseFromLink(); return false;">Case Details</a>&nbsp;&nbsp;&nbsp; </li>
            <li></li>
            <li><a href="User_Preferences.php">User Preferences</a></li>
           <!-- <li><a href="Admin_Console.html">Admin Console</a></li>-->

            <li></li>
        </ul>
    </div>
    <div id="body" style="width: 930px; height: 350px">
        <div id="content" style="width: 900px; height: 300px">

            <form id="addHearingForm" name="addHearingForm" method="POST" action="processHearing.php">
                <table id="hearingTable" >
                    <tr>
                        <td><label>Case Id: </label>
                        <input type="text"  size="2" disabled="disabled" name="caseId" id="caseIdVal" style="text-align: right"
                                <?php
                                $caseIdVal = $_GET['caseid'];
                                echo "value=\"$caseIdVal\"/>";
                            ?>
                        </td>
						<td>
                        	<div id="previousHearing">
                        	<?php
								$mysqlserver="silo.cs.indiana.edu";
                            	$mysqlusername="b561f12_64";
                            	$mysqlpassword="praveen";
                            	mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());

                            	mysql_select_db($mysqlusername) or die ("Error selecting specified database on mysql server: ".mysql_error());
								$thisCaseId = $_GET['caseid'];
								$currDate = date('m/d/Y');
								$query="SELECT Caseid,Slot,Date FROM Appointment where Caseid='$thisCaseId' and Date>='$currDate'";
                            	$result=mysql_query($query) or die ("Query to get data from appointment failed: ".mysql_error());
								
								
								if(mysql_num_rows($result)>=1)
								{
									echo "<label>Scheduled Hearing:</label>";
									while ($row=mysql_fetch_array($result,MYSQL_ASSOC))
									{
										//echo $row['Date'];
										$currdateOfHearing = $row['Date'];
										$currdateOfHearing=date('m/d/Y', strtotime(str_replace('/', '-', $currdateOfHearing)));
										echo $currdateOfHearing;	
										echo " from ";
										/*echo $row['Caseid'];
										echo ">>";
										echo $row['Date'];
										echo ">>";
										echo $row['Slot'];
										echo "---";*/
										if($row['Slot']==1)
										{
											echo "<label>10am to 12pm</label>";
										}else if($row['Slot']==2)
										{
											echo "<label>1pm to 3pm</label>";
										}else
										{
											echo "<label>3pm to 5pm</label>";
										}								
									}
									echo "<input class=\"formbutton\" style=\" margin-left:10px;\"type=\"button\" value=\"Remove\" name=\"remove\" onclick=\"removeHearing();\"></button>"; 
								}
                            
							
							?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><label>Date of Hearing</label> <input id="dateHearing" name="dateHearing" type="text" size="10" style="height:15px;" ></td>
                    </tr>


                    <tr>

<!--                        <td colspan="2">-->
<!--                            <label>Hearing Officer</label>-->
<!---->
<!---->
<!--                            <select name="employee" id="emp" onchange="getSlots(this.value);">-->
<!--                                <option></option>-->
<!---->
<!---->
<!--                                --><?php
//                                //@TODO: Hearing officer = default on add hearing and picklist on edit hearing or remove hearing officer from the add case page?
//                                //@TODO: replace with dbconnect.php
//                                $mysqlserver="localhost";
//                                $mysqlusername="";
//                                $mysqlpassword="";
//                                $link=mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());
//
//                                $dbname = "test";
//                                mysql_select_db($dbname, $link) or die ("Error selecting specified database on mysql server: ".mysql_error());
//
//                                //@TODO: change designationid=2 to 3
//                                $query="SELECT Employeeid,name FROM employee where designationid=2";
//                                $result=mysql_query($query) or die ("Query to fetch employess failed: ".mysql_error());
//
//                                while ($row=mysql_fetch_array($result,MYSQL_ASSOC))
//                                {
//                                    //echo $row;
//                                    $empid = $row['Employeeid'];
//                                    $name=$row['name'];
//                                    echo "<option value=\"$empid\">$name</option>";
//                                }
//
//                                ?>
<!---->
<!--                            </select>-->
<!--                        </td>-->
                    </tr>
                    <tr>
                            <td colspan="2">
                            <label>Time Slot</label>
                            <select id="slots" name="slot">
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input name="requestType" type="hidden" value="insertHearing"/>
                            <input  type="hidden" id="caseIdPost" name="caseIdPost" value=""/>
                            <input class="formbutton" type="button" value="Add Hearing" onclick="checkHearing();" name="save" style="margin-right:10px;">			<input type="reset" class="formbutton" value="Clear" name="clear"> <input class="formbutton" type="button" onclick="returnToCase();" name="Cancel" value="Cancel" style="margin-left:10px;"/></p>
                        </td>
                    </tr>
                </table>
            </form>
            <p>&nbsp;</p>

        </div>
        <div class="clear"></div>
    </div>

    <div id="footer">
        <div class="footer-content">
            <p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
                <a href="Help.php">Help</a>&nbsp; <a href="Contacts.php">
                    Contact Us </a></p>
			<p align="center"><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a>&copy; Student Judiciary System 2012. Design by Indiana
                University Copyrights</p>
        </div>
    </div>
</div>
</body>
</html>
