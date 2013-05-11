<?php

include "DBConnect.php";
$CaseId = $_SESSION["caseid"];
if(isset($_GET['id']))
 {
// Get the ID
    $id = intval($_GET['id']);
    // Make sure the ID is in fact a valid ID
    
      // Create the SQL query
        $query = "Delete from Document where Docid = $id;";
	 $query2 = "Delete from CaseHistoryDocs where Docid = $id;";
	//echo $query;
	$result = mysql_query($query);
	$result2 = mysql_query($query2);
	$num = mysql_numrows($result);
	$num2 = mysql_numrows($result2);
	    header("Location: Display_Document_1.php?caseid=$CaseId");

	
 }
?>


