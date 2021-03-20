<!DOCTYPE html>
<?php
  if(isset($_POST['user'])){
    //Account Creation Happens here
    $host = 'localhost:3306';
    $user = 'root';
    $pass = '';//Probally Bad Idea
    $dbname = 'hackathon';//Creative Name! :D
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn){
      die('Could not connect: '.mysqli_connect_error());
    }
    //Check if id is falid
    $stmt = $conn->prepare("SELECT ID FROM `ids` WHERE `ID` = ?");
    $row = $stmt->execute([$_POST['id']]);
    //if an id exists delete it and create the account
    if(isset($row)){
      $stmt = $conn->prepare("DELETE FROM `ids` WHERE `ID` = ?");
      $stmt->execute([$_POST['id']]);
      $stmt = $conn->prepare("INSERT INTO `users` (UserName, Password, Admin) VALUES (?, ?, 0)");
      $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT,['cost' => 12]);//dunno what cost does
      $stmt->execute([$_POST['user'],$pass]);
      session_start();
      $_SESSION['User']=$_POST['user'];
      $_SESSION['Admin'] = 0;
    }
  }
 ?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../sytle.css">
  </head>
  <body>
    <div class="header">
      <br><h1>Prideful</h1>
    </div>
    <div class="nav">
      <a class="left " href=".."><p>Home Page</p></a>
      <a class="left" href="../Protest Page"><p>Protest Page</p></a>
      <a class="left" href="../About Us"><p>About Us</p></a>
      <?php
        if(!isset($_SESSION['Admin'])){
          session_start();
        }
        if(isset($_SESSION['Admin'])){
          if($_SESSION['Admin']){
            echo '<a class="left" href="/Admin"><p>Admin</p></a>';
          }
        }
      ?>
      <a class="right active" ><p>Apply</p></a>
      <a class="right" href="../Log in"><p>Log in</p></a>
    </div>
    <div class="content">
      <form method="post">
        <input type="text" placeholder="User Name" name="user">
        <br><input type="password" placeholder="Password" name="pass">
        <br><input type="text" placeholder="Entry Id" name="id">
        <br><input type="submit">
      </form>
    </div>
  </body>
</html>
