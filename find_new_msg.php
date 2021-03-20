<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '';//Probally Bad Idea
$dbname = 'hackathon';//Creative Name! :D
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM `messages` ORDER BY `ID` DESC");
$stmt->execute([]);
echo '<div id = "msg">';
while($row = $stmt->fetch()){
  echo "<b>User: ".htmlspecialchars($row['User'])."</b>";
  echo "<p>".htmlspecialchars($row['MSG'])."</p>";
}
echo "</div>";
?>
