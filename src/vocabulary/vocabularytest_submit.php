<?php
session_start();
include '../header.php';
include '../session.php';
$uebersetzung = $_POST['name'];
$vocabularyID = $_SESSION["vocabularyID"];
$language1 = $_SESSION["language1"];
$language2 = $_SESSION["language2"];
$mistake = $_SESSION["mistake"];
$richtig = $_SESSION["richtig"];
$durchgang = $_SESSION["durchgang"];
$userid = $_SESSION["userid"];
$e = $_SESSION["e"];
$l = $_SESSION["l"];
$f = $_SESSION["f"];
function update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname)
{
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE mistake SET mistake=".$mistake." WHERE vocabularyID=".$vocabularyID." AND userid=".$userid."";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $z = $stmt->rowCount();
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
            echo "Richtig! $uebersetzung = $language2";
            $richtig = $richtig + 1;
            $durchgang = $durchgang + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            } else {
               
            }
        } else {
            echo "$uebersetzung = Richtig! Schoen, wenn mann die Gross und Kleinschreibung beachten wuerde! $language2 = $language1 ";
            $richtig = $richtig + 1;
            $durchgang = $durchgang + 1;
           
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        }
    } else {
        echo "$uebersetzung = Falsch! Richtig waere $language2 = $language1";
        $richtig = $richtig + 0;
        $durchgang = $durchgang + 1;
        $mistake = $mistake + 4;
        $z = update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
        
    }
} else {
    //language2 language1
    if (strtolower($uebersetzung) == strtolower($language1)) {
        if ($uebersetzung == $language1) {
            echo "Richtig! $uebersetzung = $language1";
            $richtig = $richtig + 1;
            $durchgang = $durchgang + 1;
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        } else {
            echo "$uebersetzung = Richtig! Schoen, wenn mann die Gross und Kleinschreibung beachten wuerde! $language2 = $language1 ";
            $richtig = $richtig + 1;
            $durchgang = $durchgang + 1;
           
            if ($mistake > 0) {
                $mistake = $mistake - 1;
                update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
            }
        }
    } else {
        echo "$uebersetzung = Falsch! Richtig waere: $language2 = $language1";
        $richtig = $richtig + 0;
        $durchgang = $durchgang + 1;
        $mistake = $mistake + 4;
        update($mistake, $vocabularyID, $userid, $servername, $username, $password, $dbname);
    }
}
$vocabularyID = $vocabularyID + 1;
$_SESSION["richtig"] = $richtig;
$_SESSION["durchgang"] = $durchgang;
echo"<p><a href = 'vocabularytest.php?vocabularyID=".$vocabularyID."&e=".$e."&l=".$l."&f=".$f."' tabindex='1'>weiter</a></p>";
echo "</center>";
