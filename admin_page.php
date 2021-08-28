<?php
session_start();
require_once "./mvc/view.php";

$view = new View();


$admin = false;
$loggedIn = false;

if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1){
    $admin = true;
}

if (isset($_SESSION['user_type']) &&  $_SESSION['user_type'] >= 1)
{
    $loggedIn = true;
}

?>

<!doctype html>
<html lang="en">

<?php include("./components/head.php") ?>
<body class="app" >
<div class="content">

    <section>
       <?php include("./components/navbar.php") ?>
    </section>
    <div id="tabs">
        <ul class="nav nav-pills nav-justified" style="background:transparent; border: 1px solid black;">
            <li class="nav-item">
                <a onclick="toggleTabs(this)" class="active btn first" href='#tabs-1' style="text-transform: uppercase; color:#000; display: block;">Trainings</a>
            </li>
            <li class="nav-item">
                <a onclick="toggleTabs(this)" class="btn second" href='#tabs-2' style="text-transform: uppercase;color:#000;display: block;">Users</a>
            </li>
            <li class="nav-item">
                <a onclick="toggleTabs(this)" class="btn third" href='#tabs-3' style="text-transform: uppercase;color:#000;display: block;">Categories</a>
            </li>
        </ul>
    
        <div class="variety pt-4" id="tabs-1">
            <div class="c">
                <div class="section-title">
                    <h2 class="text-center btn-get-started"><b>TRAININGS</b></h2>
                    <br>
                </div>
                <div class="con">
                    <?php   
                    $trainings = $view->getAllTrainings();
                    for ($i=0; $i < sizeof($trainings); $i++) { 
                        $value = $trainings[$i];
                        echo "
                            <div class='ex'>
                                <div style='display:flex; justify-content:center;'>
                                    <form style='flex:1; padding:0 30%;'>
                                        <div style='display: flex;justify-content: center;flex-direction: column;'>
                                            <div class='ee'>
                                                <div class='l'>
                                                    <iframe src='$value[video_link]' width='300' controls></iframe>
                                                </div>
                                                <div class='r'>
                                                    <div class='d'>
                                                        <b>Exercise name:</b> $value[exercise_name]
                                                    </div>
                                                    <div class='d'>
                                                        <b>Duration:</b> $value[exercise_duration]
                                                    </div>
                                                    <div class='d'>
                                                        <b>Description:</b> $value[description]
                                                    </div>
                                                    <div class='d'>
                                                        <b>Rating:</b> $value[rating_sum]
                                                    </div>
                                                </div>
                                            </div>

                                            <button onclick=\"Block(this, 'exercise',$value[ex_id])\" type='button' class='btn btn-secondary' style='margin:15px 0; background-color: #ff6666'>BLOCK / UNBLOCK</button>
                                            <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                <span class='message'></span>
                                                <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>             
                            ";
                        }
                    ?>
                </div>
            </div>
        </div>
    
    
        <div class="variety pt-4" id="tabs-2">
            <div class="c">
                <div style="display:flex;flex-flow:row wrap; ">
                    <div style="justify-content: center;flex:1;">
                        <div class="section-title">
                            <h2 class="text-center btn-get-started"><b>USERS</b></h2>
                        </div>
                        <?php
                            $users = $view->users();
                            echo "
                            <div>
                                <div style='display:flex; justify-content:center;'>
                                    <form style='flex:1; padding:0 30%;'>
                                        <div style='display: flex;justify-content: center;flex-direction: column;'>
                                            <select class='form-select' style='display:block;' name='id'>
                                                <option disabled selected>User</option>
                                                ";
                                                    for ($i=0; $i < sizeof($users); $i++) { 
                                                        $value = $users[$i];
                                                        if($value['user_type'] !== "Admin"){
                                                            echo "
                                                                <option value='$value[id_user]'>$value[email] $value[user_type]</option>
                                                            ";
                                                        }
                                                    }
                                            echo "
                                            </select>
                                            <button onclick=\"Block(this, 'user')\" type='button' ".(sizeof($users) > 0 ? "" : "disabled='true'")." class='btn btn-secondary' style='margin:15px 0;'>BLOCK / UNBLOCK</button>
                                            <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                <span class='message'></span>
                                                <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>             
                            ";
                        ?>
                    </div>

                    <div style="justify-content: center;flex:1;">
                        <div class="section-title">
                            <h2 class="text-center btn-get-started"><b>Coaches</b></h2>
                        </div>
                        <?php
                            $users = $view->users();
                            echo "
                            <div>
                                <div style='display:flex; justify-content:center;'>
                                    <form style='flex:1; padding:0 30%;'>
                                        <div style='display: flex;justify-content: center;flex-direction: column;'>
                                            <select class='form-select' style='display:block;' name='id'>
                                                <option disabled selected>User</option>
                                                ";
                                                    for ($i=0; $i < sizeof($users); $i++) { 
                                                        $value = $users[$i];
                                                        if($value['user_type'] == "Coach"){
                                                            $rating = $value['rating_sum'] != 0 ? $value['rating_sum'] / $value['rating_count']: 0 ;
                                                            echo "
                                                                <option value='$value[id_user]'>$value[email] Rating: $rating</option>
                                                            ";
                                                        }
                                                    }
                                            echo "
                                            </select>
                                            <button onclick=\"Block(this, 'coach')\" type='button' ".(sizeof($users) > 0 ? "" : "disabled='true'")." class='btn btn-secondary' style='margin:15px 0;'>BLOCK / UNBLOCK</button>
                                            <div class='alert alert-info alert-dismissible visually-hidden mt-3' role='alert'>
                                                <span class='message'></span>
                                                <button type='button' onclick='RemoveMessage(this)' class='btn-close'>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>             
                            ";
                        ?>
                    </div>

                </div>
            </div>
        </div>


        <div id='tabs-3'>
            <?php 
            $category = $view->getCategories();
            $renderForm =  htmlspecialchars(json_encode($category));
            echo "
            <div class='search-job1 text-center'>
                <div class='js text-center'>
                    <h2>Categories</h2>
                </div>
                <form class='row gx-5 justify-content-center'>
                    <div class='col-md-3'>
                        <label for='validationDefault03' class='form-label text-center'>Exercise Categories</label>
                        <select onchange=\"renderForm(this, '$renderForm' )\" class='form-select' id='validationDefault02' name='active'>
                            <option value=''>Status</option>
                            ";
                            for ($i = 0;$i < sizeof($category);$i++)
                            {
                                $value = $category[$i];
                                echo "<option value='$i'>$value[category_name]</option>";
                            }
                            echo "
                        </select>
                    </div>
                </form>
                <section id='jobs1'>
                    <div class='categories' style='padding:30px;display:flex;justify-content:center;'>
                        <h3 style='text-align:center;margin:1.5rem 0;'><b>Categories</b></h3>
                    </div>
                </section>
                <div class='mt-3'><button onclick=\"renderNewCategory()\" class='btn btn-outline my-2 my-sm-0' style='border-color:black;'>New Category</button></div>
            </div>";
            ?>
        </div>

    </div>
    
</div>
    <?php   
        include "./components/footer.php";
    ?>

</body>
<script>
    $( function() {
        $( "#tabs" ).tabs({
            active: "tabs-1"
        });
    } );
</script>
</html>