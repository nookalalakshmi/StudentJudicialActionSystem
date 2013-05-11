<?php
// Contact subject
$subject = $_POST['subject'];
$pong = $_POST['pong'];
// Details
$message=$_POST['detail'];

// Mail of sender
$mail_from=$_POST['customer_mail'];
$name = $_POST['name'];
// From
$header="from: $name <$mail_from>";

// Enter your email address
$to ='akshay.palzz@gmail.com';

if($pong=='ping')
{
$send_contact=mail($to,$subject,$message,$header);

// Check, if message sent to your email
// display message "We've recived your information"
if($send_contact){
header("Location: http://www.cs.indiana.edu/cgi-pub/lnookala/Home_Page.php");
echo "We've received your contact information";
}
else {
echo "ERROR";
}
}
else
{
	echo "Access denied. Please use the form from our site";
}
?>