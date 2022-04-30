<?php
    $db = mysqli_connect('localhost:3307','root','','foodorder');
    $que="SELECT * FROM `menu`";
    $result = mysqli_query($db, $que);
    $cus_feed="SELECT * FROM `customer_feedback`";
    $feed_res = mysqli_query($db, $cus_feed);
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Home</title>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/all.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!--My css-->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
  </head>
 <body style="background-image:url(food.jpg);">

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand " href="#"><b>FOOD<span>ORDER</span></b></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home </a>
                </li>
                <li class="nav-item">
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
    <h1 class="text-center pt-2 " style = "background:rgba(245,222,179,0.459)"><font color="800000">
        STAR RESTURANT
    </font>
    </h1>
        <div class="contain container-fluid">
            <div class="menuContainer">
                <?php
                $x=0;
                    while($rows = mysqli_fetch_assoc($result))
                    {
                ?>
                <div class="menuItem" id="item<?php echo $x;?>">
                    <div class="simple">
                        <h3 id="offer" style="display:<?php if($rows['isoffer']==0){echo "none";}?>;">Offer</h3>
                        <?php
                            if($rows['category']=="veg"){
                        ?>
                        <img class="no-border" src="css/veg.png" alt="veg image" style="width: 30px; height: 40px;">
                        <?php
                            }
                            else if($rows['category']=="nonveg"){
                        ?>
                        <img class="no-border" src="css/non-veg.png" alt="veg image" style="width: 30px; height: 40px;">
                        <?php
                            }
                        ?>
                    </div>
                    <img class="border" src="<?php echo $rows['image']; ?>" alt="food image">
                    <h6><?php echo $rows['item']; ?></h6>
                    <h6 class="price"><?php if($rows['isoffer']==1){
                        $c = $rows['id'];
                        $checkp = "SELECT `discount`, `max_dis` FROM `offers` WHERE `itemno`= $c";
                        $exeq = mysqli_query($db, $checkp);
                        while($off_row = mysqli_fetch_assoc($exeq)){
                            $off_p=($rows['price']/100)*$off_row['discount'];
                            if($off_p>$off_row['max_dis']){
                                echo $rows['price']-$off_row['max_dis'];
                            }
                            else{
                                echo $rows['price']-$off_p;
                            }
                        }
                        }
                        else{echo $rows['price'];}
                            ?> Rs</h6>
                    <div class="buttons">
                        <a type="submit" class="btn btn-warning btn-sm" href="createOffer.html">Create Offer</a>
                        <button type="submit" class="btn btn-warning btn-sm" onclick="deleteBtn(document.getElementById(`item<?php echo $x;?>`))">Delete Item</button>
                    </div>
                </div>
                <?php
                    $x++;
                    }
                ?>
            </div>
            <div class="customerFeedback">
                <h2 class="heading">feedback</h2>
                <?php
                    while($rows_feed = mysqli_fetch_assoc($feed_res))
                    {
                ?>
                <div class="cus-feedback">
                    <i class="fa fa-user-circle avtar" aria-hidden="true"><span class="cus-name"><?php echo $rows_feed['cus_name']; ?></span></i>
                    <h5 class="rating"><?php echo $rows_feed['cus_rating']; ?><i class="fa fa-star star-img" aria-hidden="true"></i></h5>
                    <p class="comment">
                        <?php echo $rows_feed['cus_feedback']; ?>
                    </p>
                    
                </div>
                <?php
                    }
                ?>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        function showinfo(){
            alert("Sairaj is Working on this page");
        }

        function deleteBtn(ele){
            console.log(ele);
            document.getElementById("offer").style["display"]="none";
            alert("Do you want to delete the item")
            ele.style["display"]="none";
        }
    </script>
</body>
</html>
