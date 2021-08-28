<?php
session_start();
require "mvc/view.php";

$admin = false;
$loggedIn = false;

if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1){
    $admin = true;
}

if (isset($_SESSION['user_type']) &&  $_SESSION['user_type'] >= 1)
{
    $loggedIn = true;
}


$view = new View();

$coaches = $view->coaches();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Coaches</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="main.js"></script>

</head>

<body>
    <div class="main">

        <?php include "./components/navbar.php"; include "./components/head.php";?>

        <div class="main_home">
            <h1><b>Personal trainers</b></h1>
            <h2 class="trainer"><u>Pick your perfect trainer!</u></h2>
        </div>

        <br><br>
        <div class='trainers'>
                <?php 
                for ($i=0; $i < sizeof($coaches); $i++) { 

                    $value = $coaches[$i];
                    $rating = $value['rating_sum'] != 0 ? $value['rating_sum'] / $value['rating_count']: 0 ;
                    echo "
                    <div class='element'>
                        <div class='leftbox'>
                            <h4>1. <b> $value[firstname] $value[lastname]</b></h4><br>
                            <p>
                                First name: $value[firstname]<br>
                                Last name: $value[lastname]<br>
                                Bio: $value[biography]<br>
                                Phone: $value[phone]<br>
                            </p>
                            <div>
                                Rating $rating
                                ";
                                if($loggedIn){
                                    echo "<div><input type='range' min='1' max='5'onchange=\"UpdateCoach(this,'coach','$value[id]')\"/></div>";
                                }

                                echo "
                            </div>
                        </div>
                        <div class='rightbox'>
                            <img  src='uploads/$value[avatar]' width='500px'>
                        </div>

                        <br><br>
                    </div> 
                    ";
                }
                ?> 
        </div>

        <?php
            include "./components/footer.php";
        ?>

    </div>
</body>

</html>
<?php
include "db_config.php";