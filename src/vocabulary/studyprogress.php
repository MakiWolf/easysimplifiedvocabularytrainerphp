<?php session_start();
include '../header.php';
include '../session.php';

$e = $_GET['e']; //Ende
$s = $_GET['s']; //Start
if (!isset($_SESSION['userid'])) {
    die('no userid!');
}
try {
    echo "<center><table border><tr><td>VokabelID</td><td>language1</td><td>language2</td><td>mistake</td></tr>";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $statement = $pdo->prepare("SELECT vocabulary.vocabularyID, vocabulary.language1, vocabulary.language2, mistake.mistake FROM vocabulary INNER JOIN mistake ON vocabulary.vocabularyID = mistake.vocabularyID WHERE mistake.userid = '" . $_SESSION["userid"] . "' AND mistake > 0 AND vocabulary.ID BETWEEN :s AND :e ORDER BY mistake DESC");
    $statement->execute(array('s' => $s, 'e' => $e));
    while ($row = $statement->fetch()) {
        echo "<tr><td>" . $row['vocabularyID'] . "</td><td>" . $row['language1'] . "</td><td>" . $row['language2'] . "</td><td>" . $row['mistake'] . "</td></tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
echo "</table><a href ='studyprogress.php?s=" . ($s = $s - 100) . "&e=" . ($e = $e - 100) . "'> < </a>&nbsp;<a href ='studyprogress.php?s=" . ($s = $s + 200) . "&e=" . ($e = $e + 200) . "'> > </a></center>";
echo "</div>";
include '../footer.php';
