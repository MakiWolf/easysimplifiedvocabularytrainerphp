<?php
session_start();
include '../header.php';
include '../session.php'; ?>
<center>
        <p><b>new:</b></p>
        <form method="post" action="newvocabulary_submit.php">
                <span>language1: </span><input type="text" name="language1" maxlength="30" required=""><br>
                <span>language2: </span><input type="text" name="language2" maxlength="30" required=""><br>
                <input type="submit" value="create">
        </form>
</center>
<?php include '../footer.php'; ?>