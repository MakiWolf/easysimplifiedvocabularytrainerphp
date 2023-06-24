<?php
session_start();
include '../header.php';
include '../session.php';
include '../function.php';

$pw = bin2hex(random_bytes(4));

try {
    $conn = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $Username = $_POST["Username"];
   

    echo "<center>";
    $userexist = checkifuserexist($connstring, $Username);
   

    if (empty(!$Username) && $userexist == "") {

        newuser($connstring, $Username);
        $userid = checkifuserexist($connstring, $Username);
        $tablemistake = "mistake" . $userid;

        $sql = "CREATE USER '" . $Username . "'@'localhost' IDENTIFIED BY '" . $pw . "';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "CREATE TABLE `Dbvocabulary`.`" . $tablemistake . "` (vocabularyID int(11) NOT NULL AUTO_INCREMENT primary key, userid int(11) NOT NULL, mistake int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "GRANT SELECT, UPDATE, INSERT ON `Dbvocabulary`.`" . $tablemistake . "` TO '" . $Username . "'@'localhost';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "GRANT SELECT ON `Dbvocabulary`.`vocabulary` TO '" . $Username . "'@'localhost';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql = "GRANT SELECT ON `Dbvocabulary`.`user` TO '" . $Username . "'@'localhost';";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo "<h3>login data</h3>";
        echo "<p>username: " . $Username . "</p>";
        echo "<p>password: " . $pw . "</p>";

        $sql = "FLUSH PRIVILEGES;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    } else {
        echo "username or userid not filled out or user or userid exist already!";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


$conn = null;
echo "</center>";
include '../footer.php';
