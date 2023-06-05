<?php include 'header.php'; ?>
<center>
  <form action="login.php" method="post" name="Login_Form">
    <h3>welcome:</h3>
    <input id="user" alt="username" type="text" name="user" placeholder="username" required="" autofocus="" />
    <input id="password" type="password" alt="password" name="password" placeholder="password" required="" />
    <button name="submit" value="login" alt="login" type="submit">login</button>
  </form>
</center>
<?php include 'footer.php'; ?>