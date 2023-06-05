<?php
session_start();
session_destroy();
include 'header.php'; ?>
<center>
    <?php echo "logout!"; ?>
    <p><br>
        <a href='index.php'><button type='button'>back to start</button></a>
    </p>
</center>
</div>
<?php
header("Location: index.php");
include 'footer.php';
?>