<?php 
session_start();
unset($_SESSION['full_name']);
header("Location:login.php");
?>