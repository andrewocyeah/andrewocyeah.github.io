<!DOCTYPE html>
<?php
  //Account Creation Happens here
  $host = 'localhost:3306';
  $user = 'root';
  $pass = '';//Probally Bad Idea
  $dbname = 'hackathon';//Creative Name! :D
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if(isset($_POST['id'])){
    $stmt = $conn->prepare("INSERT INTO `ids` VALUES (?)");
    $stmt->execute([$_POST['id']]);
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
        session_start();
        if(isset($_SESSION['Admin'])){
          if($_SESSION['Admin']){
            echo '<a class="left admin" href="/Admin"><p>Admin</p></a>';
          }else{
            if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
              $uri = 'https://';
            } else {
              $uri = 'http://';
            }
            $uri .= $_SERVER['HTTP_HOST'];
            header('Location: '.$uri.'/');
            exit;
          }
        }else{
          if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
            $uri = 'https://';
          } else {
            $uri = 'http://';
          }
          $uri .= $_SERVER['HTTP_HOST'];
          header('Location: '.$uri.'/');
          exit;
        }
      ?>
      <a class="right" href="../Apply"><p>Apply</p></a>
      <a class="right" href="../Log in"><p>Log in</p></a>
    </div>
    <div class="content">
      <form method="post">
        <input type="text" placeholder="New ID" name="id">
        <br><input type="submit">

      <?php
        $stmt = $conn->prepare("SELECT * FROM `ids`");
        $stmt->execute([]);
        while($row = $stmt->fetch()){
          echo "<br><label>".$row[0]."</label>";
        }
      ?>
      </form>
    </div>

    <div class="content">
      <?php
        if(isset($_POST['name'])){
          $stmt = $conn->prepare("DELETE FROM `users` WHERE `UserName` = ?");
          $stmt->execute([$_POST['name']]);
        }
        $stmt = $conn->prepare("SELECT * FROM `users`");
        $stmt->execute([]);
        while($row = $stmt->fetch()){
          echo "
          <form method='post'>
            <label>".$row[0]."</label>
            <input type='hidden' name='name' value='".$row[0]."'>
            <input type='submit' value='Delete'>
          </form><br>";
        }
      ?>
    </div>
  </body>
</html>
