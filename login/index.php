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

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login</title>
    <?php  include("../components/head.php");?>
</head>
<body>
<div class="container-login">
    <form action="web.php" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
        <br>
        <div class="input-group">
            <input type="email" id="loginUsername" placeholder="Email" name="username" required>
        </div>
        <div class="input-group">
            <input type="password" id="loginPassword" placeholder="Password" name="password" required>
        </div>
        <div class="input-group">
            <input type="hidden" name="action" value="login">
            <button type="submit" class="btn">Login</button>
        </div>
    </form>
    <br>
        <a href="#" id="fl" style="color: black;">Forgot password?</a>
        <form action="web.php" method="post" name="forget" id="forget" class="login-email" style="display:none; margin-top:5px;">
            <div class="input-group" style="margin:5px;">
                <input type="email" id="forgetEmail" placeholder="Email"
                    name="email">
            </div>
            <div class="input-group" style="margin:5px;">
                <input type="hidden" name="action" value="forget">
                <button type="submit" class="btn" style="transform: none;">Send</button>
            </div>
        </form>

    <br><br>
    <p class="login-register-text">Don't have an account? <a href="register.php" style="text-decoration:underline">Register Here</a>.</p>


    <?php

        $l = 0;

        if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
            $l = (int)$_GET["l"];

            if (array_key_exists($l, $messages)) {
                echo '
                <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                    '.$messages[$l].'
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

</body>
</html>