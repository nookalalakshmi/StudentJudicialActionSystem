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
	include 'DBConnect.php';
    if(!isset($_SESSION['views']))
    {
        header("Location:index.php");
    }
	$Permission = $_SESSION["Permission"];
	$UserName = $_SESSION["username"];
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
	?>
<script>
    var studentNameList = new Array();
    //var formLoad = true;
    var studentList,victimBox, victimList,selectedVictimId, codeBox, codeList,selectedCodeId,studentBox,studentList,selectedStudentId;


function initVars()
{
    victimBox=document.getElementById('victims');
    victimList=document.getElementById('victimList');
    selectedVictimId=document.getElementById('selectedVictimId');

    codeBox=document.getElementById('codes');
    codeList=document.getElementById('codeList');
    selectedCodeId=document.getElementById('selectedCodeId');

    studentBox=document.getElementById('students');
    studentList=document.getElementById('responsibleList');
    selectedStudentId=document.getElementById('selectedStudentId');
}
    $(document).ready(function () {
        initVars();
			$("#dateOccurred").datepicker({ maxDate: 0 });
			$("#dateReferred").datepicker({ maxDate: 0 });


        $( "#codes" ).autocomplete({
            source: "fetchCodesofCondut.php",
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
            select:function(event,ui)
            {
                $('#selectedCodeId').val(ui.item.id);
            },
	        messages: {
			noResults: null,
			results: null
		    }
        });

    $( "#students" ).autocomplete({

        source: "fetchStudents.php",
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
        },
        select:function(event,ui)
        {
            $('#selectedStudentId').val(ui.item.id);

        }

    });

	$( "#victims" ).autocomplete({
            source: "fetchStudents.php",
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
		    },
            select:function(event,ui)
            {
                $('#selectedVictimId').val(ui.item.id);
            }

        });

});
	
	function confirmCancel()
	{
		var response = confirm("Are you sure?");
		if(response==true)
		{
			window.open("Home_Page.php","_parent");
		}else
		{
			return;
		} 
	}

    function validate()
    {
        var validData = false;
        var occDate = document.getElementById('dateOccurred');
        var refDate = document.getElementById('dateReferred');

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = mm+'/'+dd+'/'+yyyy;


        if(occDate.value =='' || occDate.value ==null)
        {
            alert('Please select date of Occurence');
            occDate.focus();
            return validData;
        }
        if(refDate.value ==null|| refDate.value=='')
        {
            alert('Please select date of Referral');
            refDate.focus();
            return validData;
        }

        /*if(occDate.value>today)
        {
            alert('Date of occurrence cannot be after today');
            occDate.value='';
            occDate.focus();
            return validData;
        }*/
        /*if(refDate.value>today)
        {
            alert('Date of referral cannot be after today');
            refDate.value='';
            refDate.focus();
            return validData;
        }*/
        if(occDate.value > refDate.value)
        {
            alert('Date of occurrence cannot be after date of referral');
            occDate.value='';
            occDate.focus();
            return validData;
        }

        if(studentList.options.length==0)
        {
            alert('Please select a student involved in the case.');
            studentBox.focus();
            return validData;
        }
        /*if(victimList.options.length==0)
        {
            alert('Please select a victim in the case.')
            victimBox.focus();
            return validData;
        }*/
        if(codeList.options.length==0)
        {
            alert('Please select a code of conduct violated in the case.')
            codeBox.focus();
            return validData;
        }
		if(document.getElementById('referrer').value=='' || document.getElementById("referrer").value==null)
        {
            alert('Please enter the name of the referrer.');
            document.getElementById('referrer').focus();
            return validData;
        }
        validData = true;
        return validData;
    }
    function validateSubmit()
    {
        var validationResult = validate();

        if(validationResult)
        {
            for (var i = 0; i < studentList.options.length; i++) {
                studentList.options[i].selected = true;
            }
            for (var i = 0; i < victimList.options.length; i++) {
                victimList.options[i].selected = true;
            }
            for (var i = 0; i < codeList.options.length; i++) {
                codeList.options[i].selected = true;
            }
            document.forms["addCaseForm"].submit();
        }else return;

    }

function addVictimToList()
{
    var alreadyAdded = false;
    if(victimBox.value!="" && victimBox.value!=null)
    {
        for(i=0;i<victimList.length;i++)
        {
            if(victimList.options[i].value == selectedVictimId.value)
            {
                alert("Victim already added to list.");
                alreadyAdded = true;
                break;
            }
        }
        if(!alreadyAdded)
        {
            victimList.options[victimList.options.length]=new Option(victimBox.value,selectedVictimId.value,false,false);
            victimBox.value="";
        }
    }
    //else alert('Please select a Victim to add to the list.');
}

function addCodeToList()
{
    var alreadyAdded=false;
    if(codeBox.value!="" && codeBox.value!=null)
    {
        for(i=0;i<codeList.length;i++)
        {
            if(codeList.options[i].value == selectedCodeId.value)
            {
                alert("Code of Conduct already added to list.");
                alreadyAdded = true;
                break;
            }
        }
        if(!alreadyAdded)
        {
            codeList.options[codeList.options.length]=new Option(codeBox.value,selectedCodeId.value,false,false);
            codeBox.value="";
        }
    }
    else alert('Please select a Code of Conduct to add to the list.');
}

function addStudentToList()
{
    var alreadyAdded=false;
    if(studentBox.value!="" && studentBox.value!=null)
    {
        for(i=0;i<studentList.length;i++)
        {
//            alert(studentList.options[i].value);
//            alert(selectedStudentId.value);
            if(studentList.options[i].value == selectedStudentId.value)
            {
                alert("Student already added to list.");
                alreadyAdded = true;
                break;
            }
        }
        if(!alreadyAdded)
        {
            studentList.options[studentList.options.length]=new Option(studentBox.value,selectedStudentId.value,false,false);
            studentBox.value="";
        }

    }
    else alert('Please select a student to add to the list.');
}

function removeFromList(list)
{
	//var studentList=document.getElementById('responsibleList');
	var i;
	for (i = list.length - 1; i>=0; i--) {
    		if (list.options[i].selected) {
      			list.remove(i);
   		}
  	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Case</title>
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
        <h3>Add Case</h3>
		<div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo $UserName?></label></div>        
    </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li>
            <?php
				
				if($Permission == 1)
				{
				$UserName = $_SESSION["StudentName"];
				}
				if($Permission==1)
				{
					echo "<a href=\"StudentHome.php\">Home</a>";
				}else
				{
					echo "<a href=\"Home_Page.php\">Home</a>";
				}
			?>
            </li>
            <li></li> 
            <li></li>
            <li><a href="User_Preferences.php">User Preferences</a></li>
            <li></li>
            <!--<li><a href="Contacts.php">Contact Us</a></li>-->
            <li></li>
        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
		<div id="content" style="width: 905px; height: 847px">
			
			<form id="addCaseForm" name="addCaseForm" method="POST" action="createCase.php">
                <table id="caseCreationTable" >
                <tr>
                    <td><label>Date Occured</label> <input id="dateOccurred" name="dateOcc" type="text" size="10" style="height:15px;"></td>
                    <td><label>Date Referred</label> <input id="dateReferred" name="dateRef"type="text" size="10" style="height:15px;"></td>
                </tr>
                <tr>
				<td colspan="2">
                    <div id="studentsDiv" class="ui-widget">
                    <label>Student Responsible</label><input id="students"  autocomplete="off"/>

                    <input type="hidden" id="selectedStudentId" name="student_id" value="" />
				    <input type="button" class="formbutton" value="Add" id="addStudentBtn" onClick="addStudentToList();">
                    </div>
                </td>
                </tr>
                <tr>
                    <td colspan="2">
				    <select id="responsibleList" name="responsibleList[]" multiple="multiple" size="2"  style="width:60%;"></select>
				    <input type="button" class="formbutton" value="Remove" style="margin-left:1%;" id="removeStudentBtn" onClick="removeFromList(document.getElementById('responsibleList'));">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="ui-widget">
                            <label>Victim</label> <input id="victims" autocomplete="off"/>
                            <input type="hidden" id="selectedVictimId" name="victim_id" value="" />
                            <input type="button" class="formbutton" value="Add" id="addVictimBtn" onClick="addVictimToList();">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <select id="victimList" name="victimsList[]" multiple="multiple" size="2"  style="width:60%;"></select>
                        <input type="button" class="formbutton" value="Remove" style="margin-left:1%;" id="removeVictimBtn" onClick="removeFromList(document.getElementById('victimList'));">
                    </td>
                </tr>
                <tr>
                <td colspan="2">
                <label>Description</label>
				<p><textarea rows="10" name="descBox" cols="56"></textarea></td>
                </tr>
                 <tr>
                     <td >
                    <label>Referrer</label> <input id="referrer" name="referrer" type="text" size="10" style="width:50%; height:15px;">
                     </td>
                     <td>
                    <label>Location</label> <input id="location" name="location" type="text" size="10" style="width:50%;height:15px;">
                     </td>
                 </tr>
                <tr>
                    <td colspan="2">
                        <div class="ui-widget">
                        <label>Voilates Code</label> <input id="codes" name="codes" autocomplete="off"/>
                        <input type="hidden" id="selectedCodeId" name="code_id" value="" />
                        <input type="button" class="formbutton" value="Add" id="addCodeBtn" onClick="addCodeToList();">
                        </div>
                    </td>
                </tr>
                <tr>
                        <td colspan="2">
                            <select name="code_List[]" id="codeList" multiple="multiple" size="2"  style="width:60%;"></select>

                            <input type="button" class="formbutton" value="Remove" style="margin-left:1%;" id="removeCodeBtn" onClick="removeFromList(document.getElementById('codeList'));">
                        </td>
                </tr>
                <tr>
                    <td>
                    <label>Status</label> <input id="status" name="status" value="OPEN" type="text" disabled="disabled" size="10" style="font-style: italic; font-family: Calibri; height:15px;">
                    </td>
                    <td>
                    <label>Hearing Officer</label>
                    <select name="employee">
                     <?php

                            //@TODO: replace with dbconnect.php
                            $mysqlserver="silo.cs.indiana.edu";
                            $mysqlusername="b561f12_64";
                            $mysqlpassword="praveen";
                            mysql_connect($mysqlserver, $mysqlusername, $mysqlpassword) or die ("Error connecting to mysql server: ".mysql_error());

                            //$dbname = "test";
                            mysql_select_db($mysqlusername) or die ("Error selecting specified database on mysql server: ".mysql_error());
							
							 
                            $query="SELECT Employeeid,name FROM Employee where designationid=3";
                            $result=mysql_query($query) or die ("Query to get data from employee failed: ".mysql_error());

                            while ($row=mysql_fetch_array($result,MYSQL_ASSOC))
                            {
                                //echo $row;
                                $empid = $row['Employeeid'];
                                $name=$row['name'];
                                echo "<option value=\"$empid\"\>$name</option>";
                            }

                        ?> 

                    </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
				        <input type="button" class="formbutton" value="Save Case" onclick="validateSubmit();" name="save" style="margin-right:10px;"><input type="reset" value="Clear" class="formbutton" name="clear"> <input class="formbutton" type="Button" value="Cancel" name="Cancel" style="margin-left:10px;" onclick="confirmCancel();"></p>
                    </td>
                </tr>
            </table>
			</form>
			<p>&nbsp;</p>
            
        </div>
        
<!--        <div class="sidebar">
            <ul>	
               <li>
                    <h4><span>Navigate</span></h4>
                    <ul class="blocklist">
                        <li><a href="http://www.cs.indiana.edu/cgi-pub/lnookala/Home_Page.php">Home</a></li>
						<li><a href="http://www.cs.indiana.edu/cgi-pub/shrukest/User_Preferences.php">User Preferences</a></li>
						<li><a href="http://www.cs.indiana.edu/cgi-pub/akshgupt/Pages/Contacts.php">Contact Us</a></li>
                    </ul>
                </li>
                
                <li>
                    <ul>
                        <li>&nbsp;</li>
                    </ul>
                </li>
                
            </ul> 
        </div> -->
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
