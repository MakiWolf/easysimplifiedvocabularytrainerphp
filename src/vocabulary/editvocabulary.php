<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';
echo "<center>";
$id = $_GET["id"];
viewtables("", "", $servername,$dbname,$charset, $username, $password, "editvocabulary", $id);
echo "</center>";
include '../footer.php';
