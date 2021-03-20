<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="sytle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    window.setInterval(function(){
      $("#msg").load("find_new_msg.php");
    },1000);
    </script>
  </head>
  <body>
    <div class="header">
      <br><h1>Protest</h1>
    </div>
    <div class="nav">
      <a class="left active" href="#"><p>Home Page</p></a>
      <a class="left" href="/Protest Page"><p>Protest Page</p></a>
      <a class="left" href="/About Us"><p>About Us</p></a>
      <?php
        session_start();
        if(isset($_SESSION['Admin'])){
          if($_SESSION['Admin']){
            echo '<a class="left" href="/Admin"><p>Admin</p></a>';
          }
        }
      ?>
      <a class="right" href="/Apply"><p>Apply</p></a>
      <a class="right" href="/Log in"><p>Log in</p></a>
    </div>
    <div class="content">
      <div class="message">
        <form method="post">
          <input name="MSG">
          <input type="submit">
        </form>
        <?php
          $host = 'localhost:3306';
          $user = 'root';
          $pass = '';//Probally Bad Idea
          $dbname = 'hackathon';//Creative Name! :D
          $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          if(isset($_POST["MSG"])){
            $stmt = $conn->prepare("SELECT * FROM `messages` ORDER BY `ID` DESC");
            $stmt->execute([]);
            $first_row = $stmt->fetch();
            if($first_row){
              $id = $first_row[2] + 1;
            }else{
              $id = 0;
            }
            $stmt = $conn->prepare("INSERT INTO `messages` VALUES (?, ?, ?)");
            $user = "Anon";
            if(isset($_SESSION['User'])){
              $user = $_SESSION['User'];
            }
            $stmt->execute([$user,$_POST["MSG"],$id]);
          }
          $stmt = $conn->prepare("SELECT * FROM `messages` ORDER BY `ID` DESC");
          $stmt->execute([]);
          echo '<div id = "msg">';
          while($row = $stmt->fetch()){
            echo "<b>User: ".htmlspecialchars($row['User'])."</b>";
            echo "<p>".htmlspecialchars($row['MSG'])."</p>";
          }
          echo "</div>";
        ?>
      </div>

      <div class="board">
          <?php
            $stmt = $conn->prepare('SELECT * FROM `protests`');
            $stmt->execute([]);
            while($row = $stmt->fetch()){
              echo "
                <div class='content'>
                  <h1>".htmlspecialchars($row[0])."</h1>
                  <p>".htmlspecialchars($row[1])."</p>
                </div>
              ";
            }
          ?>
      </div>
    </div>
  </body>
</html>
