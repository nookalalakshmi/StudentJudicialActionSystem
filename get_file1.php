 <?php
// Check if a file has been uploaded
$dbHost = "silo.cs.indiana.edu";
$dbUserAndName = "b561f12_64";
$dbPass = "praveen";
//echo "Hi";
$DocData1 = "DocData";
 if(isset($_GET['id']))
 {
// Get the ID
    $id = intval($_GET['id']);
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
        die('The ID is invalid!');
    }
    else {
        // Connect to the database
        $con = mysql_connect($dbHost, $dbUserAndName, $dbPass);
        if(!$con)
		{
	die("Error in Connecting".mysql_error());
		}
	mysql_select_db($dbUserAndName) or die ("Database $dbUserAndName not found on host $dbHost");
    }
    // Create the SQL query
        $query = "SELECT * from Document where Docid = $id;";
	//echo $query;
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	if($num==1)
	{
	    //$Data1 = base64_decode(mysql_result ($result, 0, $DocData1));
		$Data1 = mysql_result ($result, 0, $DocData1);
		$type = mysql_result($result,0,"DocType");
		$size = mysql_result($result,0,"DocSize");
		$names = str_replace(" ", "", mysql_result($result,0,"DocName"));
	while (@ob_end_clean());
	  //  $names = mysql_result($result,0,"DocName");
	//     header("Content-Type: ". 'text/plain');
		header("Content-Type: ". '$type');
	     header("Content-Length: ". $size);
	    header("Content-Disposition: attachment; filename=". $names);
	header("Content-transfer-encoding: binary");
	   echo $Data1;

	}
	else
	{
	    echo 'Error! SQL query failed:' . mysql_error();
	}

 }
?>