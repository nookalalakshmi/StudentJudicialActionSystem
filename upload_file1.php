 <?php
// Check if a file has been uploaded
$dbHost = "silo.cs.indiana.edu";
$dbUserAndName = "b561f12_64";
$dbPass = "praveen";
//echo "Hi";
$CaseID = $_GET["caseid"];
echo $CaseID;
if(isset($_FILES['uploaded_file'])) {
//echo "1";
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        // Connect to the database
//echo "2";
       // $dbLink = new mysqli('127.0.0.1', 'user', 'pwd', 'myTable');
	$con = mysql_connect($dbHost, $dbUserAndName, $dbPass);
	if(!$con)
		{
	die("Error in Connecting".mysql_error());
		}
	mysql_select_db($dbUserAndName) or die ("Database $dbUserAndName not found on host $dbHost");

	//echo "3";
       echo $today = date("Y-m-d");
        // Gather all required data
        $names = addslashes($_FILES['uploaded_file']['name']);
//echo $names;
        $mime = $_FILES['uploaded_file']['type'];
//echo $mime;
      //$datas = base64_encode(addslashes(file_get_contents($_FILES['uploaded_file']['tmp_name'])));
          $datas = addslashes(fread(fopen($_FILES['uploaded_file']['tmp_name'],'r'),filesize($_FILES['uploaded_file']['tmp_name'])));
//echo $data;
        $size = intval($_FILES['uploaded_file']['size']);
//echo $size;
 	//while (@ob_end_clean());
        // Create the SQL query
        $query = "Insert into Document values(0,'$today','$size','$mime','$datas',trim('$names'));";
 // echo $query;
        // Execute the query
        $result = mysql_query($query);
	$query2 = "select Docid from Document order by Docid desc limit 1;";
	 $res2 = mysql_query($query2);
	 $docid = mysql_result($res2,0,"Docid");
	 echo $docid;
	 echo $CaseID;
	 $query3 = "insert into CaseHistoryDocs values($CaseID,0,$docid);";
	 $res3 = mysql_query($query3);
	 
	
//echo $result;
$num = mysql_numrows($result);
echo $num;
//echo $num;
if($result && $res3) {
    // Make sure there are some files in there
            echo 'Successful';
header("Location: Display_Document_1.php");
    
	//echo "Here";
	}
	else {
        
	echo "Error!";
      	}
}
else
{
//echo "<A HREF='javascript:window.alert('Example of a link that displays an alert box');'> link </A>:";
//echo "No file Sent";
//echo '<script type="text/javascript">document.write("<b>Hello world</b>")</script>';
//print "<script type=\"text/javascript\"> alert('No File Entered'); </script>";
//sleep(2);
header("Location: Display_Document_1.php");
}

}

?>