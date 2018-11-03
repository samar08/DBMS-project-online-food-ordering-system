<?php
session_start();
$_SESSION['RID']="";
$link=mysqli_connect('localhost','root','','dbmsproject');
$sql="SELECT * FROM RESTAURANT";
$records=mysqli_query($link,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Restaurants</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
	body{
		background-image: url("asd.jpg");
	}
		table,a,h2{
			color: white;
		}
		
	</style>
</head>
<body>
<h2 align="center" >RESTAURANTS</h2>
<table width="600" border="5" cellpadding="5" cellspacing="5" align="center">
	<tr>
	<th>
		RID
	</th>
	<th>Restaurant name</th>
	<th>Ratings</th>
	<th>Menu</th>
	
</tr>
<form method="POST" action="menu.php">
		<?php
while ($Restaurant=mysqli_fetch_assoc($records)) {
	# code...
	echo "<tr>";
	echo "<td>".$Restaurant['RID']."</td>";
	echo "<td>".$Restaurant['RNAME']."</td>";
	echo "<td>".$Restaurant['RATINGS']."</td>";	
	echo "<td>  <input type='submit'  name='RID' value='".$Restaurant['RID']."'> View Menu</td>";
	echo "</tr>";
}
		?>
		</form>
</table>

<button style="margin-left: 25%;"><a href="cart.php" >Go to cart</a></button>
<button><a href="order.php" >Go to orders page</a></button>
<button><a href="mainindex.php" >Home</a></button>
</body>
</html>
