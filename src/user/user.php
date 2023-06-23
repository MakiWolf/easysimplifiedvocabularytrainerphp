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
echo "<h3>change password</h3>";
echo"<form method='post' action='changepassword.php'>
<input type='password' name='password0' id='password0' placeholder='current password' autocomplete='off' required=''>
<input type='password' name='password1' id='password1' placeholder='new password' autocomplete='off' required=''>
<input type='password' name='password2' id='password2' placeholder='new password' autocomplete='off' required=''>
<br><br>
<input type='submit' value='change password'>
</form><br>";
echo "<h3>all users in your course</h3>";
alluserprofiles($connstring);
echo "</table></center>";
echo "</div>";
include '../footer.php';
