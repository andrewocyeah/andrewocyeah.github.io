<!DOCTYPE HTML>
<html>
	<head>
		<title>About Us</title>
		<link rel="stylesheet" type="text/css" href="../sytle.css">
		<style></style>
		<script></script>
	</head>
	<body>
		<div class="header">
      <br><h1>Prideful</h1>
    </div>
		<div class="nav">
        <a class="left " href=".."><p>Home Page</p></a>
        <a class="left" href="../Protest Page"><p>Protest Page</p></a>
        <a class="left active"><p>About Us</p></a>
				<?php
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
			<h2>About Us:</h2>
			<p>This is a piece of text. It's meant to explain who we are. However, we'd rather just fill it and try to make it look nice. There's too much to do and thinking about this About Us page wouldn't be very helpful.</p>
			<ul><p>Names of who worked on this:</p>
				<li>Lucy Bychkov</li>
				<li>Andrew Rice</li>
				<li>Jing Xuan Sun</li>
				<li>Ryan Gao</li>
			</ul>
		</div>
	</body>
