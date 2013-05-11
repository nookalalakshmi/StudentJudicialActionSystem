<?php

include "DBConnect.php";
if(isset($_GET['id']))
 {
// Get the ID
    $id = intval($_GET['id']);
    // Make sure the ID is in fact a valid ID
    
      // Create the SQL query
        $query = "Delete from Document where Docid = $id;";
	//echo $query;
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	if($num==1)
	{
	    header("Location: Display_Document_1.php");

	}
	else
	{
	    echo 'Error! SQL query failed:' . mysql_error();
	}

 }
?>


