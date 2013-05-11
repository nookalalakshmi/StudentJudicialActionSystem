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
	if (!isset($_SESSION['views']))
	{
	 header("Location: index.php");
	}
	include "DBConnect.php";
	//$CaseID = 12;
	if(isset($_SESSION['timeout']) ) 
	{	$session_life = time() - $_SESSION['timeout'];	
	   if($session_life > $inactive)        
	   { session_destroy(); 
	   	 session_unset();
	     header("Location: index.php"); 
		}
	}
	$_SESSION['timeout'] = time();
	$CaseID = $_SESSION["caseid"];

?>
<title>Document Display</title>
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
function validate()
{
	var x=document.forms["form1"]["uploaded_file"].value;
	var fileExt = x.split('.').pop();
	if(fileExt != "doc" && fileExt != "pdf" && fileExt != "png")
	{
		alert("Incorrect File Format: Use only a DOC/PDF/PNG File to Upload");
		return false;
	}
}

// -->
</script>
</head>
<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    	<h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
        <h3>Document Display&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Logout.php" ><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout"></a></h3>
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
               
            <li><a href="DisplayCase.php?edit=false&caseid=<?php echo $CaseID ?>">Case Details</a></li>
            <li><a href="Display_Document_1.php?caseid=<?php echo $CaseID ?>">Documents</a></li>
            <li><a href="User_Preferences.php">User Preferences</a></li>
            <li><a href="Contacts.php">Contact Us</a></li>
            <?php
if($_SESSION['PermDesc']=="Dean")
echo "<li><a href=\"AccountCreation.php\">Admins Console</a></li>"
?>

        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
	  <p>&nbsp;</p>
	  <div id="content" style="width: 900px; height: 847px">
        <?php 
	$query1 = "SELECT * from CaseHistoryDocs where Caseid=$CaseID order by Status;"; 
    $result = mysql_query($query1);
    $num = mysql_numrows($result);
    //echo $num;
	$DateID = "UploadDate";
	$DocName = "DocName";
	$ID = "Docid";
    if($result) 
    {
    	// Make sure there are some files in there
    	if($num == 0) 
        	{
        		echo '<p>There are no files in the database</p>';
    		}
				//echo "Here";
		else {
        	// Print the top of a table
        	echo "<table width='100%'><tr><td><b>Date</b></td>
                    <td><b>DocName</b></td>
					<td><b>Status</b></td>
		    		<td><b>Download</b></td>
				<td><b>Delete</b></td>

                </tr>";
			// Print each file
		for($i=0;$i<$num;$i++)
			{
	  		  $DocID = mysql_result ($result, $i, "Docid");
			  $Status = mysql_result ($result, $i, "Status");
			  if ($Status == 0)
				$Status = "OPEN";
			  if ($Status == 1)
				$Status = "HEARING";
 			  if ($Status == 2)
				$Status = "CLOSED";
			  $query2 = "select * from Document where Docid=$DocID;";
			  $result2 = mysql_query($query2);
			  $DateID1 = mysql_result ($result2, 0, $DateID);
	    	  $DocName2 = mysql_result ($result2,0, $DocName);
	    	  $ID1 = mysql_result($result,$i,$ID);
	    		echo "
                <tr>
                    <td>$DateID1</td>
                    <td>$DocName2</td>
					<td>$Status</td>
                    <td><a href='get_file1.php?id=$ID1'>Download</a></td>
		      <td><a href='del_file.php?id=$ID1'>Delete</a></td>

                </tr>"; 
			}
            
      		echo "</table>";  
			//header("Location: Display_Document_1.php");

      		}
		}    
    ?>
    <h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			
    
<?php 
if($permission!=1)
{
	echo "<form name='form1' action='upload_file1.php?caseid=$CaseID' method='post' onsubmit='return validate()'";
	echo "enctype='multipart/form-data'>";
	echo "<label for='file'>Filename:</label>";
	echo "<input type='file' name='uploaded_file'>";
	echo "<p></p>";
	echo "<input type='submit' name='submit' value='Submit'>";
	echo "<br>";

echo "</form>";
}
?>


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
			<p align="center"><a href="http://www.indiana.edu" id="blockiu" title="Indiana University"><img src="indy1.gif" alt="IU" width="32" height="33"></a> &copy; StudentJudicial Action: Design by Group 13: Class B561 (Fall 2012)</p>
		</div>
    </div>
</div>
</body>
</html>
