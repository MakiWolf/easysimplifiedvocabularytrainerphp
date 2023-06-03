<?php session_start();
include '../header.php';
include '../session.php';
include '../function.php';

$e = $_GET['e']; //end
$s = $_GET['s']; //start

viewtables($s, $e, $servername,$dbname,$charset, $username, $password, "vocabulary", "");

echo "<center>";
echo "<a href ='vocabularylist.php?s=".($s = $s - 10)."&e=".($e = $e - 10)."'> < </a>&nbsp;<a href ='vocabularylist.php?s=".($s = $s + 20)."&e=".($e = $e + 20)."'> > </a></center>";
echo "</div>";
include '../footer.php';
