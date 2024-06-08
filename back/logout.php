<?php 
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../front/login.php");