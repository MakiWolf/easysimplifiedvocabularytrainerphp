<?php
session_start();
include '../header.php';
include '../session.php';
$uebersetzung = $_POST['name'];
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
function update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname)
{
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE mistake" . $_SESSION["userid"] . " SET mistake=" . $mistake . " WHERE vocabularyID=" . $vocabularyID . " AND userid=" . $userid . "";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $z = $stmt->rowCount();
        //echo "update $z";
        if ($z == 0 && $mistake > 0) {
            $statement = $conn->prepare("INSERT INTO mistake" . $_SESSION["userid"] . " (vocabularyID, userid, mistake) VALUES (?, ?, ?)");
            $statement->execute(array($vocabularyID, $userid, $mistake));
        }
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        $z = 0;
    }
    $conn = null;
    return $z;
}
echo "<center>";
if ($l == "l1") {
    //language1 language2
    if (strtolower($uebersetzung) == strtolower($language2)) {

        if ($uebersetzung == $language2) {
            echo "correct! $uebersetzung = $language2";
            $correct = $correct + 1;
            $round = $round + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            } else {
            }
        } else {
            echo "$uebersetzung = upper und lowercase mistake! correct is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
            $correct = $correct + 1;
            $round = $round + 1;

            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        }
    } else {
        echo "$uebersetzung = is not correct! Right is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
        $correct = $correct + 0;
        $round = $round + 1;
        $mistake = $mistake + 4;
        update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
    }
} else {
    //language2 language1
    if (strtolower($uebersetzung) == strtolower($language1)) {
        if ($uebersetzung == $language1) {
            echo "correct! $uebersetzung = $language1";
            $correct = $correct + 1;
            $round = $round + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        } else {
            echo "$uebersetzung =  upper und lowercase mistake! correct is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
            $correct = $correct + 1;
            $round = $round + 1;

            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        }
    } else {
        echo "$uebersetzung = is not correct! Right is:" . htmlspecialchars($language2) . "=" . htmlspecialchars($language1);
        $correct = $correct + 0;
        $round = $round + 1;
        $mistake = $mistake + 4;
        update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
    }
}
$vocabularyID = $vocabularyID + 1;
$_SESSION["correct"] = $correct;
$_SESSION["round"] = $round;
echo "<p><a href = 'vocabularytest.php?vocabularyID=" . $vocabularyID . "&e=" . $e . "&l=" . $l . "&f=" . $f . "' tabindex='1'>next page</a></p>";
echo "</center>";
