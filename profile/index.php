<?php
require_once '../login/functions_def.php';
require_once "../mvc/view.php";

session_start();
if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
    redirection('../index.php');
}
$coach = false;
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3){
    $coach = true;
}
$loggedIn = true;

?>

<!doctype html>
<html lang="en">


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<body class="app">
    <div class="content">

        <section>
            <?php
            include("../components/navbar.php"); 
            include "../components/head.php"; ?>
        </section>

        <section class="sec2">

            <div class="co p-0 mb-2" style='margin-top:30px; '>
                <?php
                $view = new View();
                $data = $view->getUserData();
                for ($i = 0;$i < sizeof($data);$i++)
                {
                    $value = $data[$i];
                    echo "
                    <div class='prof'> 
                        <div class='l' style='border:2px solid #34495e; padding:15px; margin:10px;'>
                            <form action='#' >
                                <div class='fs-6' style='border-bottom:1px solid #34495e; padding-bottom:3px'>
                                    <b style='text-transform: uppercase; color:#333;'>Personal Data</b>
                                </div>
                                <div class='form-group mt-3'>
                                    <label for='firstname'><b>First Name</b></label>
                                    <input type='text' name='firstname' class='form-control' value='$value[firstname]'>
                                </div>
                                <div class='form-group mt-3'>
                                    <label for='lastname'><b>Last Name</b></label>
                                    <input type='text' name='lastname' class='form-control' value='$value[lastname]'>
                                </div>
                                <div class='form-group mt-3'>
                                    <label for='phone'><b>Mobile</b></label>
                                    <input type='text' name='phone' class='form-control' value='$value[phone]'>
                                </div>
                                ";
                                if($coach){
                                    echo"
                                    <div class='form-group mt-3'>
                                        <label for='biography'><b>Biography</b></label>
                                        <input type='text' name='biography' class='form-control' value='$value[biography]'>
                                    </div>
                                    ";
                                }
                                echo"
                                <button onclick='Update(this, \"user\")' class='btn btn-secondary mt-3' type='button'>SAVE</button>
                                <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                    <span class='message'></span>
                                    <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class='r' style='border:2px solid #34495e; padding:15px;;margin:10px; float:left;'>
                            <form action='#' >
                                <div class='' fs-6' style='border-bottom:1px solid #333;'>
                                    <b style='text-transform: uppercase; color:#333;'>New Password</b>
                                </div>
                                <div class='form-group mt-3'>
                                    <label for='password'><b>Password</b></label>
                                    <input type='password' name='password' class='form-control'>
                                </div>                
                                <div class='form-group mt-3'>
                                    <label for='cpassword'><b>Password Confirm</b></label>
                                    <input type='password' name='cpassword' class='form-control'>
                                </div>
                                <div>
                                    <button onclick='Update(this, \"user\")' class='btn btn-secondary mt-3' type='button'>SAVE</button>
                                    <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                        <span class='message'></span>
                                        <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                        </button>
                                    </div>
                                <div>
                            </form>  
                        </div>
                    </div>
                    ";
                }
                ?>
            </div>
        </section>
        <?php 
        if($coach){
            $renderForm =  htmlspecialchars(json_encode( $view->getCategories()));
            echo "
                <div onclick=\"AddExercise(this,$renderForm);\" class='btn btn-secondary m-3'>Add more</div>
            ";
        }
        ?>
        <div style="clear:both;" class="exercise">
            
            <?php
            $data = $view->getUserTrainings();
            if($coach){
                for ($i=0; $i < sizeof($data); $i++) { 
                    $value = $data[$i];
                    echo "

                    <div class='el exercises-elem card'>
                        <div class='leftb'>
                            <iframe src='$value[video_link]' width='100%' height='200px' controls></iframe>
                        </div>
                        <div class='rightb'>

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
                            <div style='display:flex;'>
                                <div class='d'>
                                    <button onclick=\"Delete('exercise','$value[ex_id]')\">Delete</button>
                                </div>

                                <div class='d'>
                                    <button  data-toggle='modal' data-target='#exmodal-$value[ex_id]'>Edit</button>
                                </div>
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
                                                <iframe src='$value[video_link]' width='300' controls></iframe>
                                            </p>
        
                                            <form>
                                                <input hidden value='$value[ex_id]' name='id'> 
                                                <div class='field-single'>
                                                    <label style='font-weight:bold;'>Exercise</label>
                                                    <input value='$value[exercise_name]' name='exercise_name' class='form-control'/>
                                                </div>
                    
                                                <div class='field-single'>
                                                    <label style='font-weight:bold;'>Duration</label>
                                                    <input value='$value[exercise_duration]' name='exercise_duration' class='form-control'>
                                                </div>
                    
                                                <div class='field-single'>
                                                    <label style='font-weight:bold;'>Description</label>
                                                    <input value='$value[description]' name='description' class='form-control'/>
                                                </div>
                                                
                                                <div>
                                                    <button type='button' onclick=\"Update(this,'exercise')\" class='btn btn-secondary mt-3'>Save</button>
                                                    <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                        <span class='message'></span>
                                                        <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
        <footer class="footer">
            <div id="copyright">
                <p>Copyright © 2021 personaltrainer.rs</p>
            </div>
        </footer>
</body>

</html>