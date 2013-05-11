<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aditya
 * Date: 14/11/12
 * Time: 2:16 PM
 * To change this template use File | Settings | File Templates.
 */
/*$host = "localhost";
$user = "";
$password = "";
$database = "test";
$con = mysql_connect($host,$user,$password);
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
*/
 include 'DBConnect.php';
 session_start();
$responsibleStudents = $_POST['responsibleList'];

$victims = $_POST['victimsList'];
$codesViolated = $_POST['code_List'];

$dateOccurred = $_POST['dateOcc'];
$dateOccurred=date('Y-m-d', strtotime(str_replace('-', '/', $dateOccurred)));

$dateReferred = $_POST['dateRef'];
$dateReferred=date('Y-m-d', strtotime(str_replace('-', '/', $dateReferred)));

$todaysDate = date('Y-m-d');

$desc = mysql_real_escape_string($_POST['descBox']);
$referrer = mysql_real_escape_string($_POST['referrer']);
$location = mysql_real_escape_string($_POST['location']);

$employee = $_POST['employee'];


mysql_query("begin");
//Insert case
//mysql_select_db($database, $con);
$query = mysql_query("INSERT INTO StudentCase (DateOcurred, DateReferred, CaseDescription, Referrer, Location, CaseStatus) VALUES ('$dateOccurred','$dateReferred','$desc','$referrer','$location',0)");
if(!$query)
{
    mysql_query("ROLLBACK");
    die('Error in inserting Case: '.mysql_error());

}


$caseId = mysql_insert_id();

//Insert caseStudentSanction
foreach($responsibleStudents as $student)
{

    $query = mysql_query("INSERT INTO CaseStudentSanction (Caseid, Studentid,Sanctionid) VALUES ('$caseId','$student',2)");
    if(!$query)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting Student Involved: '.mysql_error());

    }
	$accounts = mysql_query("SELECT Userid from LoginInfo where Userid='$student'");
	if(!$accounts)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting Student Involved: '.mysql_error());

    }
	if(mysql_num_rows($accounts)==0)
		$accounts = mysql_query("INSERT INTO LoginInfo (Userid, Password, PermissionLevel) VALUES ('$student','abcabc',1)");
		
}

//Insert caseVictims
foreach($victims as $victim)
{
    $query = mysql_query("INSERT INTO CaseVictims(Studentid, Caseid) VALUES ('$victim','$caseId')");
    if(!$query)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting Victim: '.mysql_error());

    }
}

//Insert caseViolatesCode
foreach($codesViolated as $codeViolation)
{
    $query = mysql_query("INSERT INTO CaseVoilatesCode(CaseId, CodeId) VALUES ('$caseId','$codeViolation')");
    if(!$query)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting code violation: '.mysql_error());

    }
}

//Insert employeehandlescase

    $query = mysql_query("INSERT INTO EmployeeHandlesCase(Employeeid, CaseId) VALUES ('$employee','$caseId')");
    if(!$query)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting employee case: '.mysql_error());

    }


//Insert caseHistory
    $query = mysql_query("INSERT INTO CaseHistory(CaseId,CaseNotes,Date,CaseStatus) VALUES ('$caseId','$desc','$todaysDate',0)");
    if(!$query)
    {
        mysql_query("ROLLBACK");
        die('Error in inserting case history: '.mysql_error());

    }
	
	


mysql_query("COMMIT");
echo "Inserted Successfully";
mysql_close($con);
header("location: DisplayCase.php?caseid=".$caseId."&edit=false");

?>