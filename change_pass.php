<?php
include "DBConnect.php";
$name = $_GET['username'];
echo $name;
$query = "update LoginInfo set password='abcabc' where Userid=$name";
$res = mysql_query($query);
header("Location: index.php");

?>
