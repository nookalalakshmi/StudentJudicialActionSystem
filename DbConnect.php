<?php
$dbHost = "silo.cs.indiana.edu";
$dbUserAndName = "b561f12_64";
$dbPass = "praveen";
$_TABLE_NAME= "LoginInfo";
mysql_connect ($dbHost, $dbUserAndName, $dbPass) or die ("Cannot connect to host $dbHost with user $dbUserAndName and the password provided.");
mysql_select_db ($dbUserAndName) or die ("Database $dbUserAndName not found on host $dbHost");
?>