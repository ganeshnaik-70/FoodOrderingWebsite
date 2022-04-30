<?php

$con=mysqli_connect('localhost:3307','root','','foodorder');

//$feedbackid=$_POST['feedbackid'];
//$restorentid=$_POST['restorentid'];
//$restorentname=$_POST['restorentname'];
$restorentid=5;
$restorentname="star restorent";
$issuetype=$_POST['issuetype'];
$issueinfo=$_POST['issueinfo'];
$screenshot=$_FILES['screenshot']['name'];


$sql1="INSERT INTO `issue`(`issueid`, `restorentid`, `restorentname`, `issuetype`, `issueinfo`, `screenshot`) VALUES ('0','$restorentid','$restorentname','$issuetype','$issueinfo','$screenshot')";
$result = mysqli_query($con,$sql1);

if($result)
{
	header("location:./raiseIssue.html");
}

?>
