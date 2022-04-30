<!DOCTYPE html>
<html>
<head>
	<title>FoodApp-Order Summary</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/order_summarystyle.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    <div class="dropdown">
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
<input type="date" id="date" name="date">
<select name="status" id="status">
  <option value="Delivered">Delivered</option>
  <option value="Processing">Processing</option>
  <option value="Ordered">Ordered</option>
</select>

<input type="submit"  name="submit" value="SEARCH">

<div class="container">
    <div class="table-responsive" style=" max-height: 20em;">
  <table id="table">
    <thead style="background: #00FA9A;">
    <tr>
      <th>DATE</th>
      <th>ORDER NUMBER</th>
      <th>STATUS</th>
      <th>AMOUNT</th>
    </tr>
</thead>
    <tbody>

    <?php

    $conn = new mysqli('localhost:3307','root','','foodorder');
    if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $status = $_POST['status'];
    $selectquery = " select * from orders where status = '$status' AND date = '$date'";
    $query = mysqli_query($conn,$selectquery);
    $res = mysqli_fetch_array($query);
    while($res = mysqli_fetch_array($query)){
     ?> 

    <tr>
      <td><?php echo $res['date']; ?></td>
      <td><?php echo $res['order_id']; ?></td>
      <td><?php echo $res['status']; ?></td>
      <td><?php echo $res['amount']; ?></td>
    </tr>
    <?php

    }
}

    ?>

</tbody>

  </table>
  <span id="val"></span>
</div>
</div>
<input type="text" id="total" name="total" placeholder="TOTAL AMOUNT"  >
<input type="button" value="TOTAL" onclick="add()">
        <script>
            function add()
            {
            var table = document.querySelector("table"), sumVal = 0;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                sumVal = sumVal + parseInt(table.rows[i].cells[3].innerHTML);
            }
            
               document.getElementById("total").value = sumVal;
        
            }
        </script>

</body>
</form>

</html>