<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <!-- <link rel="stylesheet" href="home.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>

<body>
    <div class="main_home">
        <?php 
            session_start();
            include("./components/head.php");
            include("./components/navbar.php");
        ?>


        <h1>PERSONAL TRAINER</h1>
        <h2 class="trainer"><u>Pick your perfect trainer!</u></h2>
        <div class="pictures">
            <img class="pic1" src="Images/pic.jpg" alt="pic1" title="picture1">
            <img class="pic2" src="Images/pic2.jpg" alt="pic2" title="picture2">
            <img class="pic3" src="Images/pic3.jpg" alt="pic3" title="picture3">
        </div>
    </div>
    <div class="container">
        <div class="left">
            <h3><b>About</b></h3>
            <div class="text">
                <p>The best and well suited place for you, <br>with support of three great trainers!</p>
            </div>
            <div class="tx">
                <i class="fas fa-map-marked-alt"></i>Štrosmajerova 75, 24000 Subotica<br>
                <i class="fas fa-phone-alt"></i> +381602587962<br>
                <i class="far fa-envelope"></i> personaltrainer@gmail.com<br>
                <i class="far fa-clock"></i> Mon - Fri: 6.30h - 22.00h<br>
                &nbsp; &nbsp;Sat: 10.00h - 22.00h<br>
                &nbsp; &nbsp;Sun: 10.00h - 20.00h<br>
            </div>
        </div>
        <div class="right">
            <img class="gym" src="Images/gym.jpg" width="450px">
        </div>
        <?php
            include "./components/footer.php";
        ?>
</body>

</html>
<?php
include "db_config.php";