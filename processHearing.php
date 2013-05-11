<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aditya
 * Date: 21/11/12
 * Time: 3:01 PM
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
mysql_select_db($database, $con);*/
 include 'DBConnect.php';
session_start();
$reqType = $_POST['requestType'];

switch($reqType)
{
    case 'insertHearing';
        addHearing();
        mysql_close($con);
		$caseId = $_POST['caseIdPost'];
        header("location: DisplayCase.php?caseid=".$caseId."&edit=false");
        break;

    case 'searchSlot';
        validateEmployeeSlot();
        break;
	case 'removeHearing';
        removeHearing();
        break;
	case 'checkHearing';
        checkHearing();
        break;
		
}

function checkHearing()
{
	$caseId = $_POST['caseid'];
	$currDate = date('m/d/Y');
	$queryCheckAppt = mysql_query("SELECT * FROM Appointment WHERE Caseid='$caseId' AND Date>='$currDate'");
	
	if(mysql_num_rows($queryCheckAppt)>=1)
	{
		echo "There is already a Hearing scheduled for this case.";
	}else 
	{
		echo "";
	}
}

function removeHearing()
{
	$caseId = $_POST['caseid'];
	$currDate = date('m/d/Y');
	$queryDelAppt = mysql_query("DELETE FROM Appointment WHERE Caseid='$caseId' AND Date>='$currDate'");
	if(!queryDelAppt)
	{
		 die('Error in deleting appointment: '.mysql_error());
		 echo "Error while deleting Appointment";
	}else
	{
		echo "Deleted";
	}
}

function addHearing()
{
    $date = $_POST['dateHearing'];
    $date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
  	$caseId = $_POST['caseIdPost'];
	//echo $caseId;
	
    
	$employeeid = $_SESSION['HearingOfficerId'];
    $slot = $_POST['slot'];
    $query = mysql_query("INSERT INTO Appointment(CaseId, Employeeid, Date, Slot) VALUES ('$caseId','$employeeid','$date','$slot')");
    if(!$query)
    {
        die('Error in inserting appointment: '.mysql_error());
    }
	
	
}

/*function validateHearingDate()
{
    $date = $_POST['hearingDate'];
    $caseId = $_POST['caseId'];
    //check whether a hearing is already added for that case;
    $query = mysql_query("SELECT CaseId,Date from  Appointment where Date >= '$date' && CaseId = '$caseId'");
    if(!$query)
    {
        die('Error in querying appointment: '.mysql_error());
    }
    while ($row=mysql_fetch_array($query,MYSQL_ASSOC))
    {
        if($row['CaseId']==$caseId)
        {
            echo json_encode("A Hearing has already been added for this case");
            return;
        }
    }
}*/

function validateEmployeeSlot()
{
    //else find free slots for that employee on that date;
    $caseId = $_POST['caseid'];
    $dateHearing = $_POST['hearingDate'];
    $dateHearing = date('Y-m-d', strtotime(str_replace('-', '/', $dateHearing)));
	
	$empid = $_SESSION['HearingOfficerId'];
    $empQuery = mysql_query("SELECT Employeeid,Slot,Date from  Appointment where Date = '$dateHearing' and Employeeid = '$empid'");

    $slots = array();
    if(!$empQuery)
    {
        die('Error in querying appointment: '.mysql_error());
    }

    $found1 = false;
    $found2 = false;
    $found3 = false;
    while ($row=mysql_fetch_array($empQuery,MYSQL_ASSOC))
    {
        if($row['Slot']=='1')
        {
           $found1=true;
        }
        else if($row['Slot']=='2')
        {
            $found2=true;
        }
        else if($row['Slot']=='3')
        {
            $found3=true;
        }

    }
    if($found1 && $found2 && $found3)
    {
        echo json_encode("None");
        return;
    }
    $res =  array();
    $res[0] = $found1;
    $res[1] = $found2;
    $res[2] = $found3;
    echo json_encode($res);

}


?>