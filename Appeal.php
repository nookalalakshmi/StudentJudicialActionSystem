<?php session_start();
include "DBConnect.php";
include "CaseStatus.php";

$Caseid = mysql_real_escape_string($_SESSION['caseid']);
$AppealedStatus = mysql_real_escape_string($StatusStringTOInt['APPEALED']);

//If Case status is changed update it in CaseHistory.
	$query = "select CaseStatus from StudentCase where Caseid = '$Caseid';";
	$result = mysql_query ($query);
	$CaseStatusDB = mysql_result ($result, 0, "CaseStatus");
	
	if($CaseStatusDB != $CaseStatus)
	{
		mysql_query("Insert into CaseHistory values('$Caseid','',CURDATE(),'$AppealedStatus');");
	}
	
	

$result = mysql_query("UPDATE StudentCase SET CaseStatus = '$AppealedStatus' WHERE Caseid = '$Caseid'");


header("Location: DisplayCase.php?caseid=$Caseid&edit=false");

?>