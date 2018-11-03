<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration OnTheWay-Online food delivery</title>
  <link rel="stylesheet" type="text/css" href="style.css">
 <!--<link rel="stylesheet" type="text/css" href="main.css">-->
 
<style type="text/css">
  
  body{
    background-image: url("details.jpg");
  }
</style>       


</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php" >
  	<?php include('errors.php'); ?>
    
  	<div class="input-group">
  	  <label>Firstname</label>
  	  <input type="text" name="firstname" value="<?php echo $firstname; ?>">
  	</div>

  	<div class="input-group">
  	  <label>middlename</label>
  	  <input type="text" name="middlename" value="<?php echo $middlename; ?>">
  	</div>
  	<div class="input-group">
  	  <label>lastname</label>
  	  <input type="text" name="lastname" value="<?php echo $lastname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Phone number</label>
  	  <input type="number" name="phonenumber" value="<?php echo $phonenumber; ?>">
  	</div>
  	<div class="input-group">
  	  <label>House number</label>
  	  <input type="text" name="housenumber" value="<?php echo $housenumber; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Street</label>
  	  <input type="text" name="street" value="<?php echo $street; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Area</label>
  	  <input type="text" name="area" value="<?php echo $area; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>
