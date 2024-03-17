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
    <title>Registration Form</title>

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
        <div class="container" style="width:900px">
            <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['c-password'];

                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                
                $errors = array();

                
                if(empty($name) OR empty($email) OR empty($password) OR empty($confirm_password)){
                    array_push($errors , "All feilds are required!");
                }

                if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
                    array_push($errors ,  "Email is not valid!");
                }
                if(strlen($password)<8){
                    array_push($errors , "Password must contain 8 characters long!");
                }
                if($password!==$confirm_password){
                    array_push($errors , "Password is not matched!");
                }
                require_once "database.php"; 
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($connection,$sql);
                $rowCount = mysqli_num_rows($result);
                if($rowCount>0){
                    array_push($errors,"Email already exists!");
                }
                if(count($errors)>0){
                    foreach($errors as $error){
                        echo "<div class = 'alert alert-danger'>$error</div>";
                    }
                }
                else{
                    
                    $sql =  "INSERT INTO users (full_name , email , password) VALUES (? , ? , ?)";
                    $stmt = mysqli_stmt_init($connection);
                    $prepare_stmt = mysqli_stmt_prepare($stmt , $sql);

                    if($prepare_stmt){
                        mysqli_stmt_bind_param($stmt , "sss" , $name , $email , $password_hash);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>You are registered successfully</div>";
                    }
                    else{
                        die("something went wrong!");
                    }
                }
            }
        
        ?>
            <h1 class="text-center">Register Now!</h1>
            <form action="registration.php" method="post">

                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="username" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <input type="passsword" class="form-control" id="password" name="password"
                        placeholder="Enter password">
                </div>
                <div class="form-group">
                    <input type="passsword" class="form-control" id="c-password" name="c-password"
                        placeholder="Confirm password">
                </div>

                <div class="form-group" style="width:100%;">
                    <input type="submit" value="Register" class="btn"
                        style="width:100%;color:#000; background-color:#fff;">
                </div>
            </form>
            <div style="color:red;width:100%" class="text-center">
                <p>Already Registered <a href="login.php" style="color:#fff; text-decoration:none; width:100%;">Login
                        Here!</a></p>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    < /body> < /
    html >