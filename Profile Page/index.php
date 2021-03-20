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
      <a class="left" href="../Protest Page"><p>Protest Page</p></a>
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

  </body>
</html>
