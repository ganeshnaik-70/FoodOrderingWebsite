<?php



$conn = new mysqli('localhost:3307','root','','foodorder');

if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $password=$_POST['password'];

    if($uname=='admin' && $password=='admin123'){
        header("Location:home.php");
        exit();
    }

  

    $sql="select * from login where username='$uname' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    

    if(mysqli_num_rows($result)){
        header("Location:customer.php");
        exit();
    }



    else{
        header("Location: login.php?error=Incorect username or password");
        exit();
    }
}

?>




<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css"/>
</head>
<body style="background-image:url(food.jpg);">
    <div class="container">
        <form method="POST" action="#">
            <h2>LOGIN</h2>
            <?php if (isset($_GET['error'])){?>
                <p class="error"><?php echo $_GET['error'];?></p>
            <?php }?>
            <div class="form_input">
                <label>User Name</label>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="formm_input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
            <button type="submit">LOGIN</button>
        </div>
        <div>
            <button class="btn btn-outline-success my-2 my-sm-0" href="customer.php" type="select">REGISTER</button>
        </div>
        </form>
    </div>
</body>
</html>
