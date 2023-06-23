<?php
session_start();
include 'header.php';
include 'session.php';
include 'function.php';

userid($connstring, $username);
$_SESSION["correct"] = 0;
$_SESSION["round"] = 0;
echo "<center><a href ='vocabulary/newvocabulary.php'>new</a></center>";
echo "<center><a href ='vocabulary/studyprogress.php?s=1&e=100'>study progress</a></center>";
echo "<center><a href ='vocabulary/vocabularylist.php?s=1&e=10'>vocabularylist</a></center>";
echo "<p><center><form action='vocabulary/vocabularytest.php' method='get'>";
echo "StartID: <input type='text' name='vocabularyID' required>";
echo " EndID: <input type='text' name='e' required>";
echo "<input type='radio' name='l' value='l1' required>language1-language2";
echo "<input type='radio' name='l' value='l2' required>language1-language2";
echo "<input type='radio' name='f' value='f1' required>mistakes";
echo "<input type='radio' name='f' value='f2' required>all";
echo "<input type='submit'></p></center>";
if ($username == "projectadmin") {
    echo "<center><h3>administration</h3></center>";
    echo "<center><a href ='user/newuser.php'>new user</a></center>";
}
include 'footer.php';
