<?php
session_start();
$firstname = "";
$middlename = "";
$lastname = "";
$phonenumber = "";
$housenumber = "";
$street = "";
$area= "";
$email = "";

$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'dbmsproject');
// initializing variables

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
   
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
   $middlename = mysqli_real_escape_string($db, $_POST['middlename']);
  $lastname =  mysqli_real_escape_string($db,$_POST['lastname']);
  $email = mysqli_real_escape_string($db,$_POST['email']);
  $phonenumber = mysqli_real_escape_string($db,$_POST['phonenumber']);
  $housenumber =  mysqli_real_escape_string($db,$_POST['housenumber']);
  $street =  mysqli_real_escape_string($db,$_POST['street']);
  $area= mysqli_real_escape_string($db, $_POST['area']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
/*echo "".$firstname."";
echo "".$middlename."";
echo "".$lastname."";
echo "".$email."";
echo "".$phonenumber."";
echo "".$housenumber."";
echo "".$street."";
echo "".$area."";*/
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "Firstname is required"); }
  if (empty($middlename)) { array_push($errors, "Middlename is required"); }
  if (empty($lastname)) { array_push($errors, "lastname is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phonenumber)) { array_push($errors, "Phone number is required"); }
  if (empty($housenumber)) { array_push($errors, "House number is required"); }
  if (empty($street)) { array_push($errors, "Street is required"); }
  if (empty($area)) { array_push($errors, "Area is required"); }

  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if($user['email']===$email){
      array_push($errors, "Email already exists");
    }
   
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users(firstname,middlename,lastname,email,housenumber,street,area,phonenumber,password) VALUES('$firstname','$middlename','$lastname','$email','$housenumber','$street','$area','$phonenumber','$password')";
  	$reg=mysqli_query($db, $query);
if($reg){
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: mainindex.php');
  }
  else{
    echo "Not registered";
  }
  }
}

if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['email'] = $email;

  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: mainindex.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>