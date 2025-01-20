<?php
include 'session_init.php';
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
