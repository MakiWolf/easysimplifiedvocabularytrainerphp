<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';

$language1 = $_POST["language1"];
$language2 = $_POST["language2"];

echo "<center>";
newvocabulary($connstring, $language1, $language2);

echo "</center>";
include '../footer.php';
