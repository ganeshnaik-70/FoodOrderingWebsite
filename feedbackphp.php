<?php

$con=mysqli_connect('localhost:3307','root','','foodorder');

//$restorentid=$_POST['restorentid'];
//$restorentname=$_POST['restorentname'];
$restorentid=5;
$restorentname="star restorent";
$rating=$_POST['rating'];
$feedbacktxt=$_POST['feedbacktxt'];


$sql1="INSERT INTO `feedback`(`restorentid`, `restorentname`, `rating`, `feedbacktxt`) VALUES ('$restorentid','$restorentname','$rating','$feedbacktxt')";
$result = mysqli_query($con,$sql1);

if($result)
{
	header("location:./feedback.html");
}

?>
