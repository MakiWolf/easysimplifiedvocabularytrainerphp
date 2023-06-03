<!DOCTYPE html>
<html lang="en">
<head>
  <title> 
    <?php
    $cookie = "";
    if (isset($_COOKIE['acceptcookies'])) {
        $cookie = $_COOKIE['acceptcookies'];
    }
    //title
    echo "project";
 
    $TagsURL = '';
    
    $CurURL ='//'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$TagsURL;
    
    if (strpos($CurURL, "/login")) {
        echo " - Login";
    }
    
    if (strpos($CurURL, "/logout")) {
        echo " - Logout";
    }
    
    if (strpos($CurURL, "/profile/profile")) {
        echo " - edit profile";
    }
    
    if (strpos($CurURL, "/profile/history")) {
        echo " - history";
    }

    //set $folder as root directory
    $folder = "/test/easysimplifiedvocabularytrainerphp/src";
    
    ?>
  </title>	
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  
  echo "<link rel='stylesheet' href='" . $folder . "/css/stylesheet.css'>";
  
   ?>
</head>
<body>
<?php
  echo "<div class='header'>";
        
          $CurURL ='//'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$TagsURL;

          if (!(strpos($CurURL, "/index"))) {
              echo "<a href='".$folder."/internal.php' class='logo'>vocabularytrainer</a>";
          }

          echo "<div class='header-right'>";
          
          //only when loged in, logout will be displayed
          if (!(strpos($CurURL, "/index") || strpos($CurURL, "/login"))) {
              echo "<a class='active' href='".$folder."/logout.php'>logout</a>";
          }
        ?>
    </div>
  </div>
