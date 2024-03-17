<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

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
            <h1>Welcome Dashboard</h1>
            <a href="logout.php" class="btn btn-warning" style="width:100%;margin-top:25px;">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>