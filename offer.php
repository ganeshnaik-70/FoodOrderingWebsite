<?php

$con=mysqli_connect('localhost:3307','root','','foodorder');

$itemno=$_POST['itemno'];
$offername=$_POST['offername'];
$discount=$_POST['discount'];
$max_dis=$_POST['max_dis'];
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];


$sql1="INSERT INTO `offers`(`itemno`, `offername`, `discount`, `max_dis`, `startdate`, `enddate`) VALUES ('$itemno','$offername','$discount','$max_dis','$startdate','$enddate');";
$result = mysqli_query($con,$sql1);
$upq="UPDATE `menu` SET `isoffer`=true WHERE `id`=$itemno;";
$update_res = mysqli_query($con,$upq);
if($result)
{
	header("location:./createOffer.html");
}

?>