<?php require_once('../app/controller.php');$con = new Controller();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJA's Home Services Inc.</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="shortcut icon" href="../assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <!-- <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.structure.min.css"> -->
    <!-- <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.theme.min.css"> -->
</head>
<body>





    <nav class="navbar navbar-expand-md fixed-top bg-light navbar-light " id="mynav">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav ">
                <li class="nav-item " data-nav="home">
                    <a class="navbar-brand mx-auto" href="index.php">
                        <img src="../assets/img/aja-l.png" width="151" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" data-nav="transactions">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input autofocus type="text" class="form-control" value="<?=isset($_GET['search'])?$_GET['search']:""?>" placeholder="Search in this page" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                <a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i></a>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </nav>







	<div class="container-fluid main-container">
        <div class="row ">
            <div class="col-md-2 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="sidepills" role="tablist" aria-orientation="vertical">
                            <!-- <a class="nav-link Home" href="index.php" >Home</a> -->
                            <a class="nav-link Appointments" href="appointments.php">Appointments</a>
                            <a class="nav-link Customers" href="customers.php">Customers</a>
                            <?php if($_SESSION['user_type']==3){?>
                                <a class="nav-link Admins" href="admins.php">Admins</a>
                            <a class="nav-link Services" href="services.php">Services</a>
                            <a class="nav-link Payment" href="payment_info_settings.php">Payment Info</a>
                            <?php }?>
                            <a class="nav-link Profile" href="profile.php">Profile</a>
                            <a class="nav-link text-danger btnLogout" href="#">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 content">
             