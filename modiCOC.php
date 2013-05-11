<html>
<head>
<title>B561 PHP/MySQL - Modify Code Of Conduct Class</title>
</head>
<body>
<p> Modify Code Of Conduct </p>

<?php 
session_start();
include "DBConnect.php"; 
$description = trim ($_POST["txtDesc"]);
$category = trim ($_POST["txtCate"]); 
$codeID = trim ($_POST["txtCID"]); 

$msg = "";

if ($category != "" && $description != "") {
	if ($codeID != "") { //modify
    	if (ctype_digit ($codeID)) {
    		$CID = (int)$codeID;
		}
		$query = "update CodeofConduct set Description = '$description', Category = '$category' where Codeid = '$CID';"; 
		mysql_query($query);
		if(mysql_affected_rows()<=0) {
			$msg = "Invalid Code of Conduct ID";
		}
	}
    else { //add
		$query = "insert into CodeofConduct values(0, '$description', '$category');"; 
		mysql_query ($query);
	}
}
else {
	$msg = "You have to enter both Category and Description.";
}

$_SESSION['message'] = $msg;
header('Location: displayCOC.php');

?>

</body>
</html>