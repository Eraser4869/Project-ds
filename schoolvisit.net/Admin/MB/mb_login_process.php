<?php

session_start();

$_SESSION['mb_loggedin'] = true;
header("Location: middleBoss.php");
exit();

?>