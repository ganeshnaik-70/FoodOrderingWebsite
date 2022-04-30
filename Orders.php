<!DOCTYPE html>
<html>
<head>
	<title>FoodApp-Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/ordersstyle.css" rel="stylesheet">

</head>
<body style="background-image:url(food.jpg);">

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand " href="#"><b>FOOD<span>ORDER</span></b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Upload Menu <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">View Orders</a>
                    <div class="dropdown" style="text-align: center;">
                    <ul>
                    	<a href="Orders.php">Accept Order</a>
                    </ul>
                    	<ul>
                        <a href="ordersummary.php">Order Summary</a>
                    </ul>
                </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="createOffer.html">Create Offer</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="raiseissue.html">Raise Issue</a>
                </li>
            </ul>
           
                <a class="btn btn-outline-success my-2 my-sm-0" href="index.php" type="select">Logout</a>
            
        </div>
    </nav>
    <br>

<form method="post">

 <div class="container">
    <div class="table-responsive">
  <table>
    <thead>
    <tr>
      <th></th>
      <th>ITEM</th>
      <th>QUANTITY</th>
      <th>COACH</th>
      <th>SEAT</th>
      <th>AMOUNT</th>
    </tr>
</thead>
    <tbody >
    <?php

    $conn = new mysqli('localhost:3307','root','','foodorder');
    $selectquery = " select * from orders where status = 'Ordered' OR status = 'Processing' ";
    $query = mysqli_query($conn,$selectquery);
    $res = mysqli_fetch_array($query);
    while($res = mysqli_fetch_array($query)){
     ?>   
    <tr>
      <td><input type="checkbox" name="check[]"value="<?php echo $res['order_id'] ?>"></td>
      <td><?php echo $res['item']; ?> </td>
      <td><?php echo $res['quantity']; ?> </td>
      <td><?php echo $res['coach']; ?> </td>
      <td><?php echo $res['seat']; ?> </td>
      <td><?php echo $res['amount']; ?> </td>
    </tr>
    <?php

    }


    ?>

</tbody>

  </table>
</div>
</div>
<input type="submit" name="but_process"value="PROCESSING" onclick="location.reload()" style="background-color: #4CAF50; margin-left: 600px; margin-top: 50px;">
<input type="submit" name="but_delivered" value="DELIVERED" onclick="location.reload()" style="background-color: #4CAF50; margin-top: 50px;">
</form>
<?php

    if(isset($_POST['but_process']))
    {
        if(isset($_POST['check']))
        {
            foreach ($_POST['check'] as $updateidp){
                mysqli_query($conn,"UPDATE orders SET status = 'Processing' WHERE order_id = '$updateidp';");
        }
        }
    }

     elseif(isset($_POST['but_delivered']))
    {
        if(isset($_POST['check']))
        {
            foreach ($_POST['check'] as $updateidd){
                mysqli_query($conn,"UPDATE orders SET status = 'Delivered' WHERE order_id = '$updateidd';");
        }
        }
    }

?>

</body>
</html>