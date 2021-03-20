<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../sytle.css">
  </head>
  <body>
    <div class="header">
      <br><h1>Protest</h1>
    </div>
    <div class="nav">
      <a class="left " href=".."><p>Home Page</p></a>
      <a class="left active"><p>Protest Page</p></a>
      <a class="left" href="../About Us"><p>About Us</p></a>
      <?php
        session_start();
        if(isset($_SESSION['Admin'])){
          if($_SESSION['Admin']){
            echo '<a class="left" href="/Admin"><p>Admin</p></a>';
          }
        }
      ?>
      <a class="right" href="../Apply"><p>Apply</p></a>
      <a class="right" href="../Log in"><p>Log in</p></a>
    </div>
    <div class="content">

      <?php
      if(isset($_SESSION['User'])){
      echo '<form method="post">
        <input name="Title" name="Title"><br>
        <input type="textarea" name="Desc"><br>
        <input type="submit">
      </form>';
    }
        $host = 'localhost:3306';
        $user = 'root';
        $pass = '';//Probally Bad Idea
        $dbname = 'hackathon';//Creative Name! :D
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST['Title'])){
          $stmt = $conn->prepare('INSERT INTO `protests` VALUES (?, ?, ?)');
          $stmt->execute([$_POST['Title'],$_POST['Desc'],$_SESSION['User']]);
        }
      ?>
    </div>
    <div class="content">
      <?php
        $stmt = $conn->prepare('SELECT * FROM `protests`');
        $stmt->execute([]);
        while($row = $stmt->fetch()){
          echo "
            <div class='content'>
              <p> By: ".htmlspecialchars($row[2])."</p>
              <h1>".htmlspecialchars($row[0])."</h1><br>
              <p>".htmlspecialchars($row[1])."</p>
            </div>
          ";
        }
      ?>
    </div>
  </body>
</html>
