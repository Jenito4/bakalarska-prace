<?php
session_name("potes");
session_start();
$_SESSION=array();
session_destroy();
header("Location: prihlaseni.php");
?>
