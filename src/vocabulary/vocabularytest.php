<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';
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
    $pdo = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($f == "f1") {
        getvocabularyf1($connstring, $vocabularyID, $userid);
        
    } else {
        $error = getvocabulary($connstring, $vocabularyID);
        getmistake($connstring, $vocabularyID, $userid);
        echo $error;
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
