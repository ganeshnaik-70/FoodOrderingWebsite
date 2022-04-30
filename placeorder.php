<?php
session_start();
include ("php/CreateDb.php");



$conn = new mysqli('localhost:3307','root','','foodorder');
$coach=$_POST['coach'];
$seat=$_POST['seat'];
if (isset($_POST['order'])){
    $product_id = array_column($_SESSION['cart'], 'id');
    foreach ($product_id as $id){
        $que = "SELECT * FROM `menu` WHERE `id`='$id'";
        $result = mysqli_query($conn,$que);
        $row = mysqli_fetch_assoc($result);
            if ($row['id'] == $id){
                $item=$row['item'];
                $amount = $row['price'];
                $q = "INSERT INTO `orders`(`item`, `quantity`, `coach`, `seat`, `amount`) 
                VALUES ('$item','1','$coach','$seat','$amount')";
                $query = mysqli_query($conn,$q);
                header("location:paymentDone.html");
            }
    }
}