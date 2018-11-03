<?php
session_start();
$email=$_SESSION['email'];
$link=mysqli_connect('localhost','root','','dbmsproject');
$sq2="SELECT * FROM SELECTED WHERE OID in(select OID FROM PLACES WHERE UEMAIL='$email') ";
$sqw="SELECT * FROM ORDERS WHERE OID IN(SELECT OID FROM PLACES WHERE UEMAIL='$email')";
$records=mysqli_query($link,$sq2);
$rec2=mysqli_query($link,$sqw);
?>
<!DOCTYPE html>
<html>
<head>
	<title>My orders</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
	body{
			background-image: url("w.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			color: white;
		}
		table,a{
			opacity: 100%;
			color: white;
		}

	</style>
</head>
<body>
	<h2 align="center">FOOD ITEM DETAILS</h2>
<table  align="center" cellspacing="5" cellpadding="5" border="5" >
	<tr>
		<th>OID</th>
		<th>Restaurant name</th>
		<th>Item name</th>
		<th>Price</th>
		<th>quantity</th>
		<th>Total cost</th>
		
	</tr>
	<?php
while ($Order=mysqli_fetch_assoc($records)){
$rnam="SELECT RNAME FROM RESTAURANT WHERE RID='".$Order['RID']."'";
$fname="SELECT FOODNAME,COST FROM MENU WHERE RID='".$Order['RID']."' AND EID='".$Order['EID']."'";
$ftem=mysqli_query($link,$fname);
$tem=mysqli_query($link,$rnam);
$rname=mysqli_fetch_assoc($tem);
$item=mysqli_fetch_assoc($ftem);
echo "<tr>";
echo "<td>".$Order['OID']."</td>";
echo "<td>".$rname['RNAME']."</td>";
echo "<td>".$item['FOODNAME']."</td>";
echo "<td>".$item['COST']."</td>";
echo "<td>".$Order['QUANTITY']."</td>";
echo "<td>".$item['COST']*$Order['QUANTITY']."</td>";

}

echo "</tr>";

?>
</table>
<p></p>
<h2 align="center">BILLING DETAILS</h2>
<table  align="center" cellspacing="5" cellpadding="5" border="5" >
	<tr>
		<th>Order Id</th>
		<th>Date</th>
		<th>time</th>
		<th>Delivery status</th>
		<th>Bill</th>
	</tr>
	<?php
while($ord=mysqli_fetch_assoc($rec2)){
echo "<tr>";
echo "<td>".$ord['OID']."</td>";
echo "<td>".$ord['DATE1']."</td>";
echo "<td>".$ord['TIME1']."</td>";
echo "<td>".$ord['DELIVERY_STATUS']."</td>";
echo "<td>".$ord['BILL']."</td>";
echo "</tr>";
}

	?>
	

</table>



<button style="margin-left: 35%;"><p><a href="restaurants.php" >Go back to restaurant's page</a></p></button>
<button ><p><a href="mainindex.php" >Home</a></p></button>
</body>
</html>