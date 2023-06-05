<?php
session_start();
include 'header.php';
include 'session.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT userid FROM user WHERE username = '" . $username . "'";
    foreach ($pdo->query($sql) as $row) {
        $_SESSION["userid"] = $row['userid'];
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
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
include 'footer.php';
