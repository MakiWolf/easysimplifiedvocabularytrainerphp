<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';
echo "<center>";
$id = $_GET["id"];
editvocabulary($connstring, $id);
echo "</center>";
include '../footer.php';
