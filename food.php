<?php
session_start();
$fname="";
$link=mysqli_connect('localhost','root','','dbmsproject');
if(isset($_POST['searchclick'])){
$fname = mysqli_real_escape_string($link,$_POST['searchbar']);
$sql="SELECT * FROM MENU WHERE FOODNAME='$fname'";
$exec=mysqli_query($link,$sql);
if($exec){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Food items</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
	body{
         background-image: url("zxc.jpg");
	}
	table,a{
		color: white;
	}
	
</style>

</head>

<body>
	<table  align ="center" border="1" cellpadding="1" cellspacing="1">
		<tr><th>Restaurant name</th>
		<th>Food Id</th>
		<th>Food name</th>
		<th>Cost</th>
<th>Add to cart</th>
</tr>
<?php
while($fitem=mysqli_fetch_assoc($exec)){
	$rnam="SELECT RNAME FROM RESTAURANT WHERE RID='".$fitem['RID']."'";

$tem=mysqli_query($link,$rnam);
$rname=mysqli_fetch_assoc($tem);

echo "<tr>";
echo "<td>".$rname['RNAME']."</td>";
echo "<td>".$fitem['EID']."</td>";
echo "<td>".$fitem['FOODNAME']."</td>";
echo "<td>".$fitem['COST']."</td>";
echo "<form method='POST' action='menu.php'>";
echo "<td> <input type='submit' name='resfood' value='".$fitem['RID']."'  > Add to cart</td>";
echo "</form>";
echo "</tr>";

}



?>

	</table>


<?php
}
else{
	echo "Entered Food item does not exist . Please check whether you have typed correctly or not";
}
}
?>
<!--<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>

</body>-->
<button style="margin-left: 20%;"><p><a href="restaurants.php" >Go back to restaurant's page</a></p></button>
<button><p><a href="order.php" >Go to orders page</a></p></button>
<button><p><a href="mainindex.php" >Home</a></p></button>
</body>
</html>