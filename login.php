<?php
    if(isset($_SESSION['user'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="css/styles.css" rel="stylesheet">
</head>

<body style="
        background-image: url('images/bg.jpg');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
      ">
    <div class="cover" style="background: transparent;
    border: 2px solid #fff;
    color: #fff;
    border-radius: 10px;
    padding: 0px 40px;
    backdrop-filter: blur(20px);
    box-shadow: 0px 0px 5px black;">
        <div class="container">
            <?php 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $email = $_POST['email'];
                $password = $_POST['password'];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connection,$sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if($user){
                    if(password_verify($password, $user["password"])){
                        session_start();
                        $_SESSION["user"] = "yes";
                        header('Location: index.php');
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password does not exist</div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Email does not exist</div>";
                }
            }
        ?>
            <h1 class="text-center">Login</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="email" placeholder="Enter your email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter your Password" name="password" class="form-control">
                </div>
                <div class="form-group" style="width: 100%">
                    <input type="submit" value="Login" name="login" class="btn"
                        style="width: 100%; background-color:#fff; color:#000;">
                </div>
            </form>
            <div>
                <p>Don't have a account?<a href="registration.php">Register Here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>