<?php 
session_start();
session_destroy();
header("Location: http://www.cs.indiana.edu/cgi-pub/lnookala/index.php");
?>