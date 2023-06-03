<?php
include 'header.php';
include 'function.php';

$username = $_POST["user"];
$password = $_POST["password"];
session_start();
$_SESSION["usern"] = $username;
$_SESSION["passwd"] = $password;

$servername = "localhost";
$dbname = "DbVokabel";
header("Location: internal.php");
include 'footer.php';
