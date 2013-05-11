<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php session_start();
	
	include "DBConnect.php";
	include "CaseStatus.php";
	
	$Caseid = mysql_real_escape_string($_SESSION["caseid"]);
	$Referrer = mysql_real_escape_string($_POST['ReferralName']);
	$DateReferred = mysql_real_escape_string($_POST['ReferralDate']);
	$Description = mysql_real_escape_string($_POST['CaseDescription']);
	$Location =  mysql_real_escape_string($_POST['Location']);
	$DateOcurred = mysql_real_escape_string($_POST['DateOcurred']);
	$CaseStatus = mysql_real_escape_string($StatusStringTOInt[$_POST['Status']]);
	$CaseNotes = mysql_real_escape_string($_POST['CaseNotes']);
	
	//If Case status is changed update it in CaseHistory.
	$query = "select CaseStatus from StudentCase where Caseid = '$Caseid';";
	$result = mysql_query ($query);
	$CaseStatusDB = mysql_result ($result, 0, "CaseStatus");
	echo "DB$CaseStatusDB\n";
	echo "P$CaseStatus";
	if($CaseStatusDB != $CaseStatus)
	{
		echo"oye";
		mysql_query("Insert into CaseHistory values('$Caseid','$CaseNotes',CURDATE(),'$CaseStatus');");
	}
	//STR_TO_DATE('$DateReferred', '%m-%d-%Y')
	//Update Case Table
	$result = mysql_query("UPDATE StudentCase SET Referrer ='$Referrer' ,DateOcurred = STR_TO_DATE('$DateOcurred', '%m-%d-%Y'), DateReferred =  STR_TO_DATE('$DateReferred', '%m-%d-%Y'), CaseDescription = '$Description', Location = '$Location', CaseStatus = '$CaseStatus' WHERE Caseid = '$Caseid'");
	if($result == false)
		echo "F";
		else echo"S";
	
	$HearingOfficerID = mysql_real_escape_string(intval(substr(strrchr($_POST['HearingOfficer'], '/'), 1 )));
	echo $HearingOfficerID;
	$result = mysql_query("UPDATE EmployeeHandlesCase SET Employeeid =$HearingOfficerID WHERE Caseid = '$Caseid'");
	
	$result = mysql_query("select Studentid from CaseStudentSanction where Caseid = '$Caseid'");
	$num = mysql_numrows ($result);
	echo $num;
	for($i=0;$i<$num;$i++)
	{
		$Studentid = mysql_result ($result, $i, "Studentid");
		$Sanctionid = mysql_real_escape_string(intval(substr(strrchr($_POST[$Studentid], '/'), 1 )));
		echo $Sanctionid;
		mysql_query("UPDATE CaseStudentSanction SET Sanctionid =$Sanctionid WHERE Caseid = '$Caseid' and Studentid = '$Studentid'");
	}
	
	if($result == false)
		echo "F";
		else echo"S";
		
		header("Location: DisplayCase.php?caseid='$Caseid'&edit=false");
?>
</body
></html>