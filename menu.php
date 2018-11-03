<?php
include 'server2.php';
$link=mysqli_connect('localhost','root','','dbmsproject');
if(isset($_POST['resfood'])){
	$RID= mysqli_real_escape_string($link,$_POST['resfood']);
	$_SESSION['RID']= $RID;
}
$RID=$_SESSION['RID'];

if(!$RID){
 $RID = mysqli_real_escape_string($link, $_POST['RID']);
 $_SESSION['RID']= $RID;}

$sql="SELECT * FROM MENU WHERE RID='$RID'";
$records=mysqli_query($link,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
	body{
		background-image: url("23.jpg");
	}
		table,a{
			color: white;
		}
		table{
			margin-top: 5%;
			border-width: 2%;
			
		}
	</style>
	<title>Menu of food items</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<h2 align="center" style="color: white;">RESTAURANT MENU</h2>
<table  align ="center" border="5" cellpadding="5" cellspacing="5">
	<tr>
		<th>Food Id</th>
		<th>Name</th>
		<th>Cost</th>
		<th>Quantity</th>
		
		<th>Add to cart</th>
	</tr>
	<?php
	while ($Resmenu=mysqli_fetch_assoc($records)) {
	echo "<tr>";
	echo "<td>".$Resmenu['EID']."</td>";
	echo "<td>".$Resmenu['FOODNAME']."</td>" ;
	echo "<td>".$Resmenu['COST']."</td>";
	echo "<form method='POST' action='menu.php'>";  
	echo "<td><input type='number' name='quantity' required> </td>";
	echo "<td> <input type='submit' name='EID' value='".$Resmenu['EID']."'>Add to cart</td>"  ;  
	echo "</form>";                     
    echo "</tr>";
}
?>
</table> 
<button style="margin-left: 15%;"><p><a href="restaurants.php" >Go back to restaurant's page</a></p></button>
	<button><p><a href="cart.php" >Go to cart</a></p></button>
	<button><p><a href="order.php" >Go to orders page</a></p></button>
	<button><p><a href="mainindex.php" >Home</a></p></button>
</body>
</html>