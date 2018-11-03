<?php
session_start();
$EID="";
$COST="";	
$date="";
$time="";
$RID="";
$quantity="";
$email="";
$OID="";
$TOTALCOST="";
$totalbill="";
$itemno="";
$link=mysqli_connect('localhost','root','','dbmsproject');

if (isset($_POST['EID']) && $_SERVER["REQUEST_METHOD"]=="POST") {

	$EID = mysqli_real_escape_string($link,$_POST['EID']);
	$sql="SELECT * FROM MENU WHERE EID='$EID'";
	$result=mysqli_query($link,$sql);
	$carmenu=mysqli_fetch_assoc($result);
	$COST=$carmenu['COST'];
	$quantity=mysqli_real_escape_string($link,$_POST['quantity']);
	$COST=(int)$COST;$quantity=(int)$quantity;
$TOTALCOST=$COST*$quantity;
$RID=$_SESSION['RID'];	
	$email=$_SESSION['email'];
	$sql="INSERT INTO CART(FID,QUANTITY,TOTALCOST,RID) VALUES('$EID','$quantity','$TOTALCOST','$RID')";
	$temp=mysqli_query($link,$sql);
	
}
if(isset($_POST['bill']) && $_SERVER["REQUEST_METHOD"]=="POST") {

$sql1="SELECT * FROM CART";
$result1=mysqli_query($link,$sql1);

$totalbill=mysqli_real_escape_string($link,$_POST['bill']);
$date=mysqli_real_escape_string($link,$_POST['date']);
$time=mysqli_real_escape_string($link,$_POST['time']);
$email=$_SESSION['email'];
$OID=rand(1,100);

$sql4="SELECT * FROM ORDERS WHERE OID='$OID'";
$chk=mysqli_query($link,$sql4);
$chkoid=mysqli_fetch_assoc($chk);
while($chkoid['OID']){
	$OID=rand(1,100);
}
$sq="INSERT INTO ORDERS(OID,DATE1,TIME1,DELIVERY_STATUS,BILL) VALUES('$OID','$date','$time',0,'$totalbill')";
$temp1=mysqli_query($link,$sq);
$sq3="INSERT INTO PLACES(uemail,OID) VALUES('$email','$OID')";
mysqli_query($link,$sq3);
while($carmen1=mysqli_fetch_assoc($result1)){
$EID=$carmen1['FID'];
$quantity=$carmen1['QUANTITY'];
$RID=$_SESSION['RID'];
$sql5="INSERT INTO SELECTED(OID,EID,RID,QUANTITY) VALUES('$OID','$EID','$RID','$quantity')";
mysqli_query($link,$sql5);	

}
$delsql="DELETE FROM CART";
mysqli_query($link,$delsql);

}
if(isset($_POST['delcart'])){
	$itemno = mysqli_real_escape_string($link,$_POST['delcart']);
	$csq="DELETE FROM CART WHERE ITEMNO='$itemno'";
$del=mysqli_query($link,$csq);



}

?>

