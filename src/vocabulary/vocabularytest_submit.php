<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';
$translation = $_POST['name'];
$vocabularyID = $_SESSION["vocabularyID"];
$language1 = $_SESSION["language1"];
$language2 = $_SESSION["language2"];
$mistake = $_SESSION["mistake"];
$correct = $_SESSION["correct"];
$round = $_SESSION["round"];
$userid = $_SESSION["userid"];
$e = $_SESSION["e"];
$l = $_SESSION["l"];
$f = $_SESSION["f"];

echo "<center>";
if ($l == "l1") {
    //language1 language2
    if (strtolower($translation) == strtolower($language2)) {

        if ($translation == $language2) {
            echo "correct! $translation = $language2";
            $correct = $correct + 1;
            $round = $round + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($connstring, $mistake, $vocabularyID, $userid);
            } else {
            }
        } else {
            echo "$translation = upper und lowercase mistake! correct is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
            $correct = $correct + 1;
            $round = $round + 1;

            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($connstring, $mistake, $vocabularyID, $userid);
            }
        }
    } else {
        echo "$translation = is not correct! Right is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
        $correct = $correct + 0;
        $round = $round + 1;
        $mistake = $mistake + 4;
        update($connstring, $mistake, $vocabularyID, $userid);
    }
} else {
    //language2 language1
    if (strtolower($translation) == strtolower($language1)) {
        if ($translation == $language1) {
            echo "correct! $translation = $language1";
            $correct = $correct + 1;
            $round = $round + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($connstring, $mistake, $vocabularyID, $userid);
            }
        } else {
            echo "$translation =  upper und lowercase mistake! correct is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
            $correct = $correct + 1;
            $round = $round + 1;

            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($connstring, $mistake, $vocabularyID, $userid);
            }
        }
    } else {
        echo "$translation = is not correct! Right is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
        $correct = $correct + 0;
        $round = $round + 1;
        $mistake = $mistake + 4;
        update($connstring, $mistake, $vocabularyID, $userid);
    }
}
$vocabularyID = $vocabularyID + 1;
$_SESSION["correct"] = $correct;
$_SESSION["round"] = $round;
echo "<p><a href = 'vocabularytest.php?vocabularyID=" . $vocabularyID . "&e=" . $e . "&l=" . $l . "&f=" . $f . "' tabindex='1'>next page</a></p>";
echo "</center>";
