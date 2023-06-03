<footer>
<?php
if ($cookie == "") {
    echo "<p id='cookie' style='text-align: center; background-color: #f1f1f1;  padding: 20px 10px;'>This website use cookies! ";
    echo "<button onclick='myFunction()'>ok</button>";
    echo "</p>";
    echo "<script>";
    echo "function myFunction() {";
    echo "document.cookie = 'acceptcookies=yes; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/';";
    echo "document.getElementById('cookie').innerHTML = '';";
    echo "}";
    echo "</script>";
}
?>
</footer>
</body>
</html>