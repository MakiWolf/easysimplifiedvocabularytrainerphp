<?php session_start();
include '../header.php';
include '../session.php';
include '../function.php';

$e = $_GET['e']; //Ende
$s = $_GET['s']; //Start
if (!isset($_SESSION['userid'])) {
    die('no userid!');
}
studyprogress($connstring, $s, $e);
echo "</table><a href ='studyprogress.php?s=" . ($s = $s - 100) . "&e=" . ($e = $e - 100) . "'> < </a>&nbsp;<a href ='studyprogress.php?s=" . ($s = $s + 200) . "&e=" . ($e = $e + 200) . "'> > </a></center>";
echo "</div>";
include '../footer.php';
