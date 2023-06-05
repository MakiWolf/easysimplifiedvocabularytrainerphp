<?php
session_start();
include '../header.php';
include '../session.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $language1 = $_POST["language1"];
    $language2 = $_POST["language2"];

    echo "<center>";

    if (empty(!$language2) && empty(!$language1)) {
        $statement = $conn->prepare("INSERT INTO vocabulary (language1, language2) VALUES (?, ?)");
        $statement->execute(array($language1, $language2));
        echo "New vocabulary created successfully";
    } else {
        echo "not filled out";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
echo "</center>";
include '../footer.php';
