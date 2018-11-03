<?php 
  session_start(); 
$db = mysqli_connect('localhost', 'root', '', 'dbmsproject');
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="main.css">
  <style type="text/css">
    body{
      background-image: url("2.jpg");
    }
    a{
      color: white;
    }
  </style>
</head>
<body>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <div class="first">
    <?php  if (isset($_SESSION['email'])) : ?>
      <?php
$sqname="SELECT FIRSTNAME FROM USERS WHERE EMAIL='".$_SESSION['email']."'LIMIT 1";
$sqres=mysqli_query($db,$sqname);
if($sqres){
  $fname=mysqli_fetch_assoc($sqres);

}

      ?>
    	<p>Welcome <strong><?php echo $fname['FIRSTNAME']; ?></strong></p>
    	<p> <a href="mainindex.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
</div>
<form method="POST" action="order.php">

<input type="submit" name="My orders" value="My orders">
</form>
<form method="POST" action="restaurants.php">
<strong><input type="submit" name="restaurants" value="Restaurants"></strong>
</form>
<!--<form method="POST" action="restaurants.php">
<input type="submit" name="food_items" value="fooditems">
</form>-->
<form method="POST" action="food.php">
<input type="text" name="searchbar" width="100dp" height="20dp" placeholder="Search for the food item" align="center">
<strong><input type="submit" name="searchclick" value="Search"></strong>
<p style="color: white;">Enter in capitals</p>
		</form>
    <form method="POST" action="issues.php">

<input type="submit" name="issues" value="If you are having any queries, please click here">
</form>
</body>
</html>