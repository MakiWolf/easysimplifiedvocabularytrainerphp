<?php
$servername = "localhost";
$username = $_SESSION["usern"];
$password = $_SESSION["passwd"];
$dbname = "DbVokabel";
$charset = "charset=utf8";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    echo "<script>";
    echo "setTimeout(function(){alert(\"!\")}, 5000);";
    echo "setTimeout(function(){}, 5000);";
    echo "window.location.href = 'index.php'";
    echo "</script>";
}
$conn = null;
echo "<center><h1>Hello $username! </h1></center>";
$CurURL ='//'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$TagsURL;
          
          
          if (strpos($CurURL, "/internal")) {
              echo "";
          } else {
              echo "<center><br><a href='".$folder."/internal.php'><button type='button'>Zurück zur Startseite</button>
			</a></center><br> ";
          }
