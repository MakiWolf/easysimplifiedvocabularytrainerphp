<?php
session_start();
include '../header.php';
include '../session.php';
$vocabularyID = $_GET['vocabularyID'];
$e = $_GET['e']; //end
$_SESSION["e"] = $_GET['e'];
$l = $_GET['l']; //language
$_SESSION["l"] = $_GET['l'];
$f = $_GET['f']; //only when mistakes
$_SESSION["f"] = $_GET['f'];
$_SESSION["vocabularyID"] = "";
$_SESSION["language1"] = "";
$_SESSION["language2"] = "";
$_SESSION["mistake"] = 0;
$userid = $_SESSION["userid"];
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($f == "f1") {
        $sql = "SELECT * FROM vocabulary INNER JOIN mistake" . $_SESSION["userid"] . " ON vocabulary.vocabularyID = mistake" . $_SESSION["userid"] . ".vocabularyID WHERE vocabulary.vocabularyID = '" . $vocabularyID . "' AND mistake" . $_SESSION["userid"] . ".userid = '" . $userid . "' AND mistake > 0";
        foreach ($pdo->query($sql) as $row) {
            $_SESSION["vocabularyID"] = $row['vocabularyID'];
            $_SESSION["language1"] = $row['language1'];
            $_SESSION["language2"] = $row['language2'];
            $_SESSION["mistake"] = $row['mistake'];
        }
    } else {
        $sql = "SELECT * FROM vocabulary WHERE vocabularyID = '" . $vocabularyID . "'";
        foreach ($pdo->query($sql) as $row) {
            $_SESSION["vocabularyID"] = $row['vocabularyID'];
            $_SESSION["language1"] = $row['language1'];
            $_SESSION["language2"] = $row['language2'];
            $_SESSION["mistake"] = null;
        }
        $sql2 = "SELECT * FROM mistake" . $_SESSION["userid"] . " WHERE vocabularyID = '" . $vocabularyID . "' AND userid = '" . $userid . "'";
        foreach ($pdo->query($sql2) as $row) {
            $_SESSION["mistake"] = $row['mistake'];
        }
    }
    //exit when finish
    if ($e < $vocabularyID) {
        echo "<p><center>result: " . $_SESSION["correct"] . "/" . $_SESSION["round"] . "</center></p>";
    } elseif ($_SESSION["vocabularyID"] == "") {
        $vocabularyID = $vocabularyID + 1;
        header("Location: vocabularytest.php?vocabularyID=" . $vocabularyID . "&e=" . $e . "&l=" . $l . "&f=" . $f . "");
    } else {
        if ($l == "l1") {
            echo "<p><center>vocabulary language1: " . htmlspecialchars($_SESSION["language1"]) . "</p>";
        } else {
            echo "<p><center>vocabulary language2: " . htmlspecialchars($_SESSION["language2"]) . "</p>";
        }
        echo "<form action='vocabularytest_submit.php' method='post'>";
        echo "translation: <input type='text' name='name' autofocus>";
        echo "<input type='submit'>";
        echo "</form>";
        echo "</center>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$pdo = null;
