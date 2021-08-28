<?php
require_once 'config.php';

echo '<script> sessionStorage.removeItem("id");</script>';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <title>Register Form - Pure Coding</title>
    <?php  include("../components/head.php");?>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container-login">
    <form action="web.php" method="post" class="login-email" enctype="multipart/form-data">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
        <div class="input-group">
            <input type="text" id="registerFirstname" placeholder="First Name" name="firstname" required>
        </div>
        <div class="input-group">
            <input type="text" id="registerLastname" placeholder="Last Name" name="lastname" required>
        </div>
        <div class="input-group">
            <input type="email" id="registerEmail" placeholder="Email" name="email" required>
        </div>
        <div class="input-group">
            <input type="text" id="registerPhone" placeholder="Phone" name="phone" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Password" name="password" required>
        </div>

        <label>Sign up as Coach</label>

        <input type="checkbox" onchange="$('.bio').toggle()"  value="1" name="coach">
        <br/>
        <div class="bio" style="display:none; margin:5px">
            <div class="input-group">
                <input type="text" class="input" id="user_email" autocomplete="off" placeholder="Biography" name="biography">
            </div>

            <div class="input-group">
                <input type="file" autocomplete="off" placeholder="Profile picture" id='photo' name='picture'>
            </div>

        </div>

        <br>

        <div class="input-group">
            <input type="hidden" name="action" value="register">
            <button type="submit" class="btn">Register</button>
        </div>
        <p class="login-register-text">Have an account? <a href="index.php" style="text-decoration:underline">Login Here</a>.</p>
    </form>
    <?php
        $r = 0;

        if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
            $r = (int)$_GET["r"];

            if (array_key_exists($r, $messages)) {
                echo '
                <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                    '.$messages[$r].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                ';
            }
        }
    ?>

</div>
<?php
    $r = 0;

    if (isset($_GET["r"]) and is_numeric($_GET['r'])) {
        $r = (int)$_GET["r"];

        if (array_key_exists($r, $messages)) {
            echo '
            <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                '.$messages[$r].'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            ';
                }
    }
?>


<script>
        $("#action").click(function(){
            $(".log_form, .reg_form").toggle(1200);
        });
</script>

<script src="js/script.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>