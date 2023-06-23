<?php
session_start();
include '../header.php';
include '../session.php';

$pw0 = $_POST["password0"];
$pw1 = $_POST["password1"];
$pw2 = $_POST["password2"];
  
try {
    $conn = new PDO($connstring, $_SESSION["usern"], $_SESSION["passwd"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if ($pw0 == $_SESSION["passwd"]) {
        
        if ($pw1 == $pw2) {
  
            //change password
            //for mysql
            //$sql = "ALTER USER '". $username ."'@'localhost' IDENTIFIED WITH mysql_native_password BY '" .$pw. "';";
            //for mariadb
            $sql = "SET PASSWORD FOR '".$username."'@'localhost' = PASSWORD('".$pw1."')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            print "changed<br>";
        }
        
        else {
            print "new password do not match repaeat password!<br>";
        }
    }
    
    else {
        print "incorrect password!<br>";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
echo "<br>";

include '../footer.php';