<!DOCTYPE html>
<html>
<head>
	<title>FoodApp-Upload Menu</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



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
                <li class="nav-item active">
                    <a class="nav-link" href="menu.php">Upload Menu <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
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
    <br><br>

     <?php
  
$conn = new mysqli('localhost:3307','root','','foodorder');
  if(isset($_POST['submit'])){
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
      $item = $_POST['item'];
    $price = $_POST['price'];
    $files = $_FILES['file'];

    

    $filename = $files['name'];
    $fileerror = $files['error'];
    $filetmp = $files['tmp_name'];

    $fileext = explode('.',$filename);
    $filecheck = strtolower(end($fileext));

    $fileextstored = array('png','jpg','jpeg');

    if(in_array($filecheck,$fileextstored)){
      $destinationfile = 'uploads/'.$filename;
      move_uploaded_file($filetmp,$destinationfile);

      $q = "INSERT INTO `menu`(`category`, `subcategory`, `item`, `price`, `image`) 
      VALUES ('$category','$subcategory','$item','$price','$destinationfile')";

      $query = mysqli_query($conn,$q);


    }

  }



?>

<form name="form" action="menu.php" method="post" onsubmit="return validation()" enctype="multipart/form-data" required>
  <label style="font-size: 18px;font-weight: bold;">Category</label>
  <select name="category" id="category" style="height:40px;">
      <option value="veg">Veg</option>
      <option value="nonveg">Non-Veg</option>
    
   
    <option label="Dessert" name="dessert" value="dessert">
    </option>
  </select>
  <br><br>

  <label style="font-size: 18px;font-weight: bold;">Sub-Category</label>
  <select name="subcategory" id="subcategory" style="height:40px;">
  <option value="na"></option>
  <option value="rice">Rice</option>
  <option value="roti">Roti</option>
  <option value="noodles">Noodles</option>
</select>
<br><br>

	<input type="text" id="item" name="item" placeholder="Item" style="height:40px;" required><br>
	<input type="text" id="price" name="price" placeholder="Price" style="height:40px;" required>
  <span id="amount" style="font-weight: bold; color: black; opacity: 1.0;"></span>
  <br><br>

	  <label for="img">Select image:</label>
  <input type="file" id="file" name="file" required>
  <span id="image1" style="font-weight: bold; color: black; opacity: 1.0;"></span>
  <br><br>

  <input type="submit" name="submit" value="ADD" href="menu.html">

</form>

<script type="text/javascript">
  
  function validation(){

    var price = document.getElementById('price').value;
    var img = document.forms['form']['file'];
    var validExt = ["jpeg","png","jpg"];

    if(isNaN(price)){
      document.getElementById('amount').innerHTML = " ** Price should be a Number";
      return false;
    }

    if(img.value!='')
    {
      var pos_of_dot=img.value.lastIndexOf('.')+1;
      var img_ext = file.value.substring(pos_of_dot);
      var result = validExt.includes(img_ext);
      console.log(result);
      if(result==false)
      {
        document.getElementById('image1').innerHTML = " ** Extension should be jpeg or jpg or png";
      return false;
      }
    }
  }

</script>


</body>
</html>