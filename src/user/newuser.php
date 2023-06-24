<?php
session_start();
include '../header.php';
include '../session.php'; ?>
<center>
<p><b>new user</b></p>
<form method="post" action="newuser_submit.php">
        <span>Username: </span><input type="text" name="Username" maxlength="30" required=""><br>
        <input type="submit" value="new user">
</form>
</center>
<?php include '../footer.php'; ?>