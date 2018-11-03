<?php
include 'server2.php';

$link=mysqli_connect('localhost','root','','dbmsproject');
$sql="SELECT * FROM CART";
$totalbill="";
$records=mysqli_query($link,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>CART</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<style type="text/css">
	table,a{
		color: white;
	}
	body{
		background-image: url("123.jpg");
	}

</style>
<body>
	<h2 align="center" style="color: white;">YOUR CART</h2>
<table  align ="center" border="5" cellpadding="5" cellspacing="5">
	<tr>
		<th>Item number</th>
        <th>Restaurant_Name</th>
		<th>Food name</th>
		<th>Quantity</th>
		<th>Total Cost</th>
		<th>Delete</th>
	</tr>
	<?php
    while($cartmenu=mysqli_fetch_assoc($records)){
echo "<tr>";
$rnam="SELECT RNAME FROM RESTAURANT WHERE RID='".$cartmenu['RID']."'";
$fname="SELECT FOODNAME,COST FROM MENU WHERE RID='".$cartmenu['RID']."' AND EID='".$cartmenu['FID']."'";
$ftem=mysqli_query($link,$fname);
$tem=mysqli_query($link,$rnam);
$rname=mysqli_fetch_assoc($tem);
$item=mysqli_fetch_assoc($ftem);
echo "<td>".$cartmenu['itemno']."</td>";
echo "<td>".$rname['RNAME']."</td>";
echo "<td>".$item['FOODNAME']."</td>";
echo "<td>".$cartmenu['QUANTITY']."</td>";
echo "<td>".$cartmenu['TOTALCOST']."</td>";
echo "<form method='POST' action='cart.php'>";
echo "<td>  Delete <input type='submit' name='delcart' value='".$cartmenu['itemno']."'> </td>";
echo "</form>";
$totalbill=$totalbill+$cartmenu['TOTALCOST'];

echo "</tr>";
    }
    ?>
    </table>
    <table align ="center" border="1" cellpadding="1" cellspacing="1">
    	
    <td>Total bill: <?php echo "$totalbill" ?></td>
   <form method='POST' action='cart.php'>
    	
<td> <input type="date" name="date" required> </td>
<td><input type="time" name="time" required></td>
<td><input type='submit' name='bill' value=<?php echo "$totalbill" ?> >Place the order</td>
   </form>
    </tr>

</table>
 



</body>
<button style="margin-left: 25%;"><p><a href="restaurants.php" >Go back to restaurant's page</a></p></button>
<button><p><a href="order.php" >Go to orders page</a></p></button>
<button><p><a href="mainindex.php" >Home</a></p></button>
</html>