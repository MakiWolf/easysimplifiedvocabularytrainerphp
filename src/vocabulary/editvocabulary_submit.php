<?php
session_start();
include '../header.php';
include '../session.php';
echo "<center>";
$id = $_POST["id"];
$language1 = $_POST["language1"];
$language2 = $_POST["language2"];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE vocabulary SET language1='".$language1."', language2='".$language2."' WHERE ID=".$id."";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo $stmt->rowCount() . " vocabulary UPDATED successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
include '../footer.php';
