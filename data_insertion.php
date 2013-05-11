<?php
include "DbConnect.php";
session_start();

$file_handle = fopen("randomdata.csv", "r");

while (($line_of_data = fgetcsv($file_handle, 1000, "|")) !== FALSE) 
{
       $line_import_query="INSERT into Student(Name,Address,Phone,Sex,Dept,BirthDate)values('$line_of_data[0]','$line_of_data[1]','$line_of_data[2]','$line_of_data[3]','$line_of_data[4]','$line_of_data[5]')";

	$result=mysql_query($line_import_query) or die(mysql_error());
	if($result)
		echo 'Inserted Data';
}
?>