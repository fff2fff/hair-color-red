<?php
if(!isset($_SESSION)) {
    session_start();
} 
if(empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
} 
echo "<!--ログイン中-->";
