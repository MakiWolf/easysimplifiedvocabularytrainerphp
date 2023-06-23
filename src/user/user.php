<?php session_start();
include '../header.php';
include '../session.php';
include '../function.php';

if (!isset($_SESSION['userid'])) {
    die('no userid!');
}
echo "<center><h3>your user data</h3>";
userprofile($connstring, $_SESSION['userid']);
echo "</table>";
echo "<h3>all users in your course</h3>";
alluserprofiles($connstring);
echo "</table></center>";
echo "</div>";
include '../footer.php';
