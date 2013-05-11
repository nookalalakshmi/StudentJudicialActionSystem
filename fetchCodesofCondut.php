<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Aditya
 * Date: 14/11/12
 * Time: 2:16 PM
 * To change this template use File | Settings | File Templates.
 */

//@TODO: replace with dbconnect.php
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
$term = $_GET['term'];
//echo $term;
//mysql_select_db($database, $con);
$query = mysql_query("SELECT codeid, description FROM CodeofConduct WHERE description LIKE '%$term%'");
//$query = mysql_query("SELECT Studentid, Name FROM Student");
$queryResult = array();
if(!$query) die('Error in querying Database:'.mysql_error());
while ($row = mysql_fetch_array($query,MYSQL_ASSOC)) {
    $row_array['id']=$row['codeid'];
    $row_array['value']=$row['description'];
    array_push($queryResult,$row_array);
}

$result = json_encode($queryResult);
//print_r ($result);
echo $result;
?>