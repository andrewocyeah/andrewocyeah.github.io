<!DOCTYPE html>
<?php
  if(isset($_POST['user'])){
    //Login Code done here
    $host = 'localhost:3306';
    $user = 'root';
    $pass = '';//Probally Bad Idea
    $dbname = 'hackathon';//Creative Name! :D
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(!$conn){
      die('Could not connect: '.mysqli_connect_error());
    }
    $stmt = $conn->prepare("SELECT Password,Admin FROM `users` WHERE `UserName` = ?");
    $stmt->execute([$_POST['user']]);
    $row=$stmt->fetch();
    echo "<p>sadfgadkjgahj</p>";
    if(isset($row[0])){

      echo "<p>sadfgadkjgahj</p>";
      if(password_verify($_POST['pass'],$row[0])){
        session_start();
        $_SESSION['User'] = $_POST['user'];//Keep Login stuff on this side
        $_SESSION['Admin'] = $row[1];
        echo "<p>sadfgadkjgahj</p>";
      }
    }
  }
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../sytle.css">
  </head>
  <body>
    <div class="header">
      <br><h1>Unnamed Thing.</h1>
      <?php
      if(!isset($_SESSION['User'])){
        session_start();
      }
      if(isset($_SESSION['User'])){
        echo "You are signed in as ".$_SESSION['User'];
      }

       ?>
    </div>
    <div class="nav">
      <a class="left " href=".."><p>Home Page</p></a>
      <a class="left" href="../Search Page"><p>Search Page</p></a>
      <a class="left" href="../Profile Page"><p>Profile Page</p></a>
      <a class="left" href="../Protest Page"><p>Protest Page</p></a>
      <a class="left" href="../About Us"><p>About Us</p></a>
      <?php
        if(isset($_SESSION['Admin'])){
          echo '<a class="left" href="/Admin"><p>Admin</p></a>';
        }
      ?>
      <a class="right" href="../Apply"><p>Apply</p></a>
      <a class="right active"><p>Log in</p></a>
    </div>
    <div class="content">
      <form method="post">
        <input type="text" placeholder="User Name" name="user">
        <br><input type="password" placeholder="Password" name="pass">
        <br><input type="submit">
      </form>
    </div>
  </body>
</html>
