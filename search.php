<?php
session_start();
require "./mvc/view.php";

$view = new View();
$search = $view->search();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>

<body class='app'>
    <div class="main_home content">
        <?php 
        include("./components/head.php");
        include "./components/navbar.php";
        ?>
        <div class="exercises">
        <?php
                for ($i=0; $i < sizeof($search); $i++) { 
                    $value = $search[$i];

                    if($value["active"]){
                        echo "
                        <div class='exercises-elem card' data-toggle='modal' data-target='#exmodal-$value[ex_id]'>
                            <div class='exercises-elem-title'>  
                                $value[exercise_name]
                            </div>
                            <div class='exercises-elem-duration'>  
                                $value[exercise_duration]
                            </div>
                            <div class='exercises-elem-duration'>  
                                $value[category_name]
                            </div>
                            <div class='exercises-elem-rating'>  
                                Watched $value[rating_sum] times
                            </div>

                        <div class='modal fade' id='exmodal-$value[ex_id]' tabindex='-1' role='dialog' aria-labelledby='modal-$value[ex_id]' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>
                                            $value[exercise_name]
                                        </h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <p class='card-text'>
                                            <iframe src='$value[video_link]' width='100%' height='250px' controls></iframe>
                                        </p>

                                        <div class='field-single'>
                                            <label style='font-weight:bold;'>Exercise</label>
                                            <div style='margin-bottom:5px;'>$value[exercise_name]</div>
                                        </div>

                                        <div class='field-single'>
                                            <label style='font-weight:bold;'>Duration</label>
                                            <div style='margin-bottom:5px;'>$value[exercise_duration]</div>
                                        </div>

                                        <div class='field-single'>
                                            <label style='font-weight:bold;'>Description</label>
                                            <div style='margin-bottom:5px;'>$value[description]</div>
                                        </div>

                                        <div class='field-single'>
                                            <label style='font-weight:bold;'>Category</label>
                                            <div style='margin-bottom:5px;'>$value[category_name]</div>
                                        </div>

                                        <div class='field-single'>
                                            <label style='font-weight:bold;'>Watched</label>
                                            <div style='margin-bottom:5px;'>$value[rating_sum]</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
        }
    ?>
    </div>
        <br><br><br><br>
        <?php
            include "./components/footer.php";
        ?>
    </div>
</body>

</html>
<?php
include "db_config.php";