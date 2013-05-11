<?php
$mysqli = new mysqli('silo.cs.indiana.edu', 'b561f12_64', 'praveen', 'b561f12_64');
$text = $mysqli->real_escape_string($_GET['term']);
 
$query = "SELECT Description,Codeid FROM CodeofConduct WHERE Description LIKE '%$text%' ORDER BY Description ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['Description']." / ".$row['Codeid'].'"}';
	//$json .= '{"value":"'.$row['Studentid'].'"}';
}
$json .= ']';
echo $json;
?>