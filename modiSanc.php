<html>
<head>
<title>B561 PHP/MySQL - Modify Sanction Class</title>
</head>
<body>
<p> Modify Sanction </p>

<?php 
session_start();
include "DBConnect.php"; 
$description = trim ($_POST["txtDesc"]);
$sanctionID = trim ($_POST["txtSID"]); 

$msg = "";

if ($description != "") {
	if ($sanctionID != "") { //modify
  		if (ctype_digit ($sanctionID)) {
    		$SID = (int)$sanctionID;
    		$query = "update Sanctions set Description = '$description' where Sanctionid = '$SID';"; 
    		mysql_query ($query);
			if(mysql_affected_rows()<=0) {
				$msg = "Invalid Sanction ID";
			}
		}
  	}
  	else { //add
		$query = "insert into Sanctions values(0, '$description');"; 
		mysql_query ($query);
	}	
}
else {
	$msg = "You have to enter a Description.";
}

$_SESSION['message'] = $msg;
header('Location: displaySanctions.php');

?>

</body>
</html>