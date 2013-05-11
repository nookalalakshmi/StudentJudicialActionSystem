<?php
$mysqli = new mysqli('silo.cs.indiana.edu', 'b561f12_64', 'praveen', 'b561f12_64');
$text = $mysqli->real_escape_string($_GET['term']);
 
$query = "SELECT Name,Studentid FROM Student WHERE Name LIKE '%$text%' ORDER BY Name ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['Name']." / ".$row['Studentid'].'"}';
	//$json .= '{"value":"'.$row['Studentid'].'"}';
}
$json .= ']';
echo $json;
?>