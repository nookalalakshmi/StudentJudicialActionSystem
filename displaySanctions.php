<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Display Sanctions </title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<script language="JavaScript">

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


function AddSanctionRadio() {
	document.getElementById("txtSID").value="";
	document.getElementById("txtDesc").value="";
	
	if(document.getElementById("AddSanc").checked) {
		document.getElementById("txtSID").disabled=true;
	}
	else document.getElementById("txtSID").disabled=false;
}

function ModifySanctionRadio() {
	document.getElementById("txtSID").value="";
	document.getElementById("txtDesc").value="";
	
	if(document.getElementById("ModiSanc").checked) {
		document.getElementById("txtSID").disabled=false;
	}
	else document.getElementById("txtSID").disabled=true;
}

</script>
</head>
<body onload="FP_preloadImgs(/*url*/'button3.jpg',/*url*/'button4.jpg',/*url*/'button6.jpg',/*url*/'button7.jpg')">
<div id="container">
	<div id="header">
    	<h1>Student Judicial Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>

        <h3>Sanctions Display&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href ="http://www.cs.indiana.edu/cgi-pub/shrukest/Logout.php"><img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout" /></a></h3>  

        <?php
        session_start();
		// set timeout period in seconds
		$inactive = 600;
		// check to see if $_SESSION['timeout'] is set
		if(isset($_SESSION['timeout'])) {
			$session_life = time() - $_SESSION['timeout'];
			if($session_life > $inactive) {
				session_destroy();
				header("Location: index.php");
			}
		}
		$_SESSION['timeout'] = time();
		if(!isset($_SESSION['views'])) {
			header("Location: index.php");
		}
        $username = $_SESSION["username"];
        ?>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear"><?php echo "$username"; ?></label></div>
    </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li><a href="Home_Page.php">Home</a></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li><a href="User_Preferences.php">User Preferences</a></li>
           
            

            <?php
            if(!isset($_SESSION['views'])) {
              header("Location: index.php");
              exit;
            }
            if($_SESSION['Permission']==4)
              echo "<li><a href=\"AccountCreation.php\">Admins Console</a></li>";
            ?>

        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
    <p style="color:Red";>
<?php
				echo "{$_SESSION['message']}";
				$_SESSION['message']="";
            ?></p>

		<?php 
			include "DBConnect.php"; 

			$query = "select * from Sanctions"; 
			$result = mysql_query ($query); 

			$num = mysql_numrows ($result); 

			echo "<table border='1'><tr><th>Sanction ID</th><th>Description</th>"; 

			for ($i = 0; $i < $num; $i++) { 
			  echo "<tr>"; 
			  $SanctionID = mysql_result ($result, $i, "Sanctionid"); 
			  $Description = mysql_result ($result, $i, "Description"); 
			  echo "<td>$SanctionID</td> <td>$Description</td>"; 
			  echo "</tr>"; 
			} 

			echo "</table>";
                        if($_SESSION['Permission']==4) {
        				
						  echo '<form action="modiSanc.php" method="post">';

                          echo '<h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>';
                          					  
                          echo '<p><input type="radio" name="selection" id="AddSanc" value="AddSanc" onclick="AddSanctionRadio()" checked="checked             				<label for="AddSanc">Add a Sanction</label> &nbsp;
                            <input type="radio" name="selection" id="ModiSanc" value="ModiSanc" onclick="ModifySanctionRadio()" />
                            <label for="ModiSanc">Modify a Sanction</label></p>';

                          echo '
                            <td width="100%" align="left"><label for="txtSID">Sanction ID</label>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" name="txtSID" id="txtSID" disabled=\"disabled\"/></td></br></br>
                             <td width="100%" align="left"><label for="txtDesc">Description</label>&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="text" name="txtDesc" id="txtDesc" /></td></br></br>
                          <input type="submit" value="Submit" class="formbutton">
                             ';
							                          
                          echo '</form>';
                
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
                        <h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
                        <p>&nbsp;</p>
            
        

    	<div class="clear"></div>
    </div>

    <div id="footer">
        <div class="footer-content">
			<p><a href="Terms_Condition.php">Terms and Conditions</a>&nbsp;
			<a href="Help.php">Help</a>&nbsp;
                        <a href="Contacts.php">Contact Us</a></p>
			<p>&copy; Student Judiciary System 2012. Design by Indiana 
			University Copyrights</p>
		</div>
    </div>
</div>
</body>
</html>



