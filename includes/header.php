<?php require_once('./app/controller.php') ?>
<?php 
    $con = new Controller();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJA's Home Services Inc.</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/font-awesome/css/font-awesome.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-md fixed-top bg-light navbar-light " id="mynav">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item " data-nav="home">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item"  data-nav="services">
                    <a class="nav-link" href="services.php">Services</a>
                </li>
                <li class="nav-item" data-nav="about">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item" data-nav="contact">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <?php if($con->logged){?> 
                    <li class="nav-item" data-nav="book">
                        <a class="btn btn-success " href="book.php">Book Now</a>
                    </li>
                <?php }?>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="index.php">
                <img src="./assets/img/aja-l.png" width="151" alt="">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <?php if($con->logged){?> 
                    <li class="nav-item" data-nav="transactions">
                        <a class="nav-link" href="transactions.php">Transactions</a>
                    </li>
                    <li class="nav-item" data-nav="register">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item" data-nav="logout">
                        <a class="nav-link text-danger btnLogout" href="#">Logout</a>
                    </li>
                <?php } else {?>
                    <li class="nav-item" data-nav="register">
                        <a class="nav-link" href="register.php">Sign up</a>
                    </li>
                    <li class="nav-item" data-nav="signin">
                        <a class="nav-link" href="signin.php">Login</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
