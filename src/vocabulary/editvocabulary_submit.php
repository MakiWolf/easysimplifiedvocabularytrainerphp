<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';
echo "<center>";
$id = $_POST["vocabularyid"];
$language1 = $_POST["language1"];
$language2 = $_POST["language2"];
editvocabularysave($connstring, $id, $language1, $language2);
include '../footer.php';
