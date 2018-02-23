<?php
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
   </head>
   <link rel="stylesheet" type="text/css" href="page_style.css">
   </header>
   <body>
    <header>
    	<nav>
    		<div class="main-wrapper">
          <ul>
            <li><a href="index.php">Home</a></li>
          </ul>

          <div class="nav-login">
            <form action="includes/login.inc.php" method="POST">
              <input type="text" name="uid" placeholder="Username"></<input>
              <input type="text" name="password" placeholder="Password"></<input>
              <button type="submit" name="submit">Login</button>
            </form>
            <a href="signup.php">Sign Up</a>
          </div>
    		</div>
    	</nav>
    </header>