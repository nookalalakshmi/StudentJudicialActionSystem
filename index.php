<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="styles.css" type="text/css" />
<script language="JavaScript">
<!--
  

</script>
</head>

<body>
<div id="container">
	<div id="header">
    	<h1><a href="/">Student Judicial Action<strong></strong></a></h1>
    	<div class="clear"></div>
    </div>
    
    <div id="body" >
    	 <img src="justice.jpeg" alt="Judicial System" height="300" width="250"> 
      <div id="content">
	    <form action="index.php" method="post">
            <table cellspacing="0" align="center">
                <tr>
                    <th colspan="2">Login to Continue</th>
              </tr>
                <tr>
                    <td width="50%">Username:</td>
                    <td width="50%"><input name="username" id="username" value="" type="text" /></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input name="password" id="password" value="" type="password" /></td>
                </tr>
                <tr>
                    <td></td>
                  <td><input name="login"  class="formbutton" value="Login" type="submit" />&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="reset"  class="formbutton" value="Clear" type="reset" />&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>

        </table>
        </form>
        <br />
        <?php session_start();
include "DbConnect.php";

$username = $_POST["username"];
$password = $_POST["password"];
$_TABLE_NAME = "LoginInfo";

$query = "Select * from $_TABLE_NAME where Userid = '$username' and Password = '$password'";
$_TableN = "Designation";
$result = mysql_query($query);
$rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$_SESSION['Permission']=$row[2];
$designation = $_SESSION['Permission'];
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;

if($username!="" && $password!="")
{	
	if($rows==1)
	{
		$queryPerm = "Select Description from $_TableN where Designationid = '$designation'";
		$resultPerm = mysql_query($queryPerm);
		$rowPerm = mysql_fetch_array($resultPerm);
		$_SESSION['PermDesc']=$rowPerm[0];
		
		if($_SESSION['Permission']==1)
		{
		   	$_SESSION['views'] = 1;
			header("location:StudentHome.php");
		}
		else
		{
			$_SESSION['views'] = 1;
			header("location:Home_Page.php");
		}
	}
	else
	{
		session_destroy();
		echo "<label style=\"color:red;\">Invalid Username/Password</label>";
	}
	
}
else
{
	session_destroy();
	echo "<label style=\"color:red;\">Please enter Username/Password</label>";
}

?>

        <br/> <br/> <br/> <br/> <br/> <br/>
        <br/> <br/> <br/> <br/> <br/> <br/>
        <br/> <br/> <br/> <br/> <br/> <br/>
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
