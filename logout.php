<?php
session_start();
unset($_SESSION["admin_name"]);
header("location:index.php");
?>