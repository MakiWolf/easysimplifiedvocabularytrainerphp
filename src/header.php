<?php
$lang = "en";
echo "<!DOCTYPE html>";
echo "<html lang='" . $lang . "'>";

echo "<head>";
echo "<title>";

$cookie = "";
if (isset($_COOKIE['acceptcookies'])) {
    $cookie = $_COOKIE['acceptcookies'];
}
//title
echo "easysimplified";

$TagsURL = '';

$CurURL = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $TagsURL;

if (strpos($CurURL, "/login")) {
    echo " - login";
}

if (strpos($CurURL, "/logout")) {
    echo " - logout";
}

if (strpos($CurURL, "/user/user")) {
    echo " - user";
}

if (strpos($CurURL, "/user/newuser")) {
    echo " - newuser";
}

if (strpos($CurURL, "/vocabulary/studyprogress")) {
    echo " - studyprogress";
}

if (strpos($CurURL, "/vocabulary/vocabularylist")) {
    echo " - vocabularylist";
}

if (strpos($CurURL, "/vocabulary/newvocabulary")) {
    echo " - new vocabulary";
}

if (strpos($CurURL, "/vocabulary/vocabularytest")) {
    echo " - vocabularytest";
}

if (strpos($CurURL, "/vocabulary/vocabularytest_submit")) {
    echo " - vocabularytest - check";
}

//set $folder as root directory
$folder = "/test/easysimplifiedvocabularytrainerphp/src";
$version = "v0.1";

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

    $CurURL = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $TagsURL;

    if (!(strpos($CurURL, "/index"))) {
        echo "<a href='" . $folder . "/internal.php' class='logo'>easysimplified - vocabularytrainer - " . $version . "</a>";
    }

    echo "<div class='header-right'>";

    //only when loged in, logout will be displayed
    if (!(strpos($CurURL, "/index") || strpos($CurURL, "/login"))) {
        echo "<a class='active' href='" . $folder . "/logout.php'>logout</a>";
    }
    ?>
    </div>
    </div>