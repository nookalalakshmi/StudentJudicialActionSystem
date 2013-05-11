<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>exalted - Free CSS Template by spyka Webmaster</title>
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
		<img border="0" id="img3" src="button2.jpg" height="20" width="100" alt="Logout" onmouseover="FP_swapImg(1,0,/*id*/'img3',/*url*/'button3.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img3',/*url*/'button2.jpg')" onmousedown="FP_swapImg(1,0,/*id*/'img3',/*url*/'button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img3',/*url*/'button3.jpg')" fp-style="fp-btn: Embossed Capsule 5" fp-title="Logout">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
        <h3>Document Display</h3>
        <div class="clear">Welcome, <label accesskey="lblUser" class="clear">User</label></div>
    </div>
    <div id="nav" style="width: 960px; height: 70px">
    	<ul>
        	<li><a href="index.html">Home</a></li>
            <li></li>
            <li></li>
            <li><a href="#">Schedule</a>&nbsp;&nbsp;&nbsp; </li>
            <li></li>
            <li></li>
            <li><a href="User_Preferences.html">User Preferences</a></li>
            <li><a href="Admin_Console.html">Admin Console</a></li>

        </ul>
    </div>
    <div id="body" style="width: 930px; height: 887px">
		<div id="content" style="width: 605px; height: 847px">
        <?php session_start();
	
	include "DBConnect.php";
	$query = "SELECT * from Document;"; 
    $result = mysql_query($query);
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
		    <td><b>&nbsp;</b></td>
                </tr>";
			// Print each file
		for($i=0;$i<$num;$i++)
			{
	  		  $DateID1 = mysql_result ($result, $i, $DateID);
	    	  $DocName2 = mysql_result ($result, $i, $DocName);
	    	  $ID1 = mysql_result($result,$i,$ID);
	    		echo "
                <tr>
                    <td>$DateID1</td>
                    <td>$DocName2</td>
                    <td><a href='get_file1.php?id=$ID1'>Download</a></td>
                </tr>"; 
			}
            
      		echo "</table>";  
			header("Location: Display_Documents.php");

      		}
		}    
    ?>
    <h2>&nbsp;</h2>
			<h2>&nbsp;</h2>
			
    <form action="upload_file1.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="uploaded_file">
<br>
<input type="submit" name="submit" value="Submit">
</form>
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
        
        <div class="sidebar">
            <ul>	
               <li>
                    <h4><span>Navigate</span></h4>
                    <ul class="blocklist">
                        <li><a href="DisplayCase.php?caseid=&lt;?php echo $caseid?&gt;&amp;edit=false">Case Details</a></li>
						<li><a href="#">Documents</a></li>
						<li></li>
                    </ul>
                </li>
                
                <li>
                    <ul>
                        <li>&nbsp;</li>
                    </ul>
                </li>
                
            </ul> 
        </div>
    	<div class="clear"></div>
    </div>

    <div id="footer">
        <div class="footer-content">
			<p><a href="examples.html">Terms and Conditions</a>&nbsp;
			<a href="examples.html">Help</a>&nbsp; <a href="examples.html">
			Contact Us </a></p>
			<p>&copy; Student Judiciary System 2012. Design by Indiana 
			University Copyrights</p>
		</div>
    </div>
</div>
</body>
</html>
