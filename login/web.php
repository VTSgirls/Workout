<?php
session_start();
require_once "config.php";
require "functions_def.php";

$username = "";
$password = "";
$passwordConfirm = "";
$firstname = "";
$lastname = "";
$email = "";
$action = "";
$phone="";
$biography="";

$referer = $_SERVER['HTTP_REFERER'];
$action = mysqli_real_escape_string($connection, $_POST["action"]);

if ($action != "" AND in_array($action, $actions) !== false) {


    switch ($action) {
        case "login":

            $username = mysqli_real_escape_string($connection, trim($_POST["username"]));
            $password = mysqli_real_escape_string($connection, trim($_POST["password"]));

            if (!empty($username) AND !empty($password)) {    
                $data = checkUserLogin($username, $password);

                if ($data AND is_int($data['id_user'])) {
                    // session_regenerate_id();
                    $_SESSION['username'] = $username;
                    $_SESSION['id_user'] = $data['id_user'];
                    $_SESSION['user_type'] = $data['user_type'];
                    // if($data['user_type']==1) redirection('../admin/');
                    // if($data['user_type']==2) redirection('../employee/');
                    // if($data['user_type']==3) redirection('../quest/');
                    redirection('../index.php');
                } else {
                    redirection('index.php?l=1');
                }

            } else {
                redirection('index.php?l=1');
            }
            break;


        case "register" :


           
            if(isset($_POST['firstname'])) {
                $firstname = mysqli_real_escape_string($connection, trim($_POST["firstname"]));
            }

            if(isset($_POST['lastname'])) {
                $lastname = mysqli_real_escape_string($connection, trim($_POST["lastname"]));
            }

            if (isset($_POST['password'])) {
                $password = mysqli_real_escape_string($connection, trim($_POST["password"]));
            }

            if (isset($_POST['phone'])) {
                $phone = mysqli_real_escape_string($connection, trim($_POST["phone"]));
            }

            if (isset($_POST['email'])) {
                 $email = mysqli_real_escape_string($connection, trim($_POST["email"]));
            }

            if (isset($_POST['biography'])) {
                $biography = mysqli_real_escape_string($connection, trim($_POST["biography"]));
            }

            if (empty($firstname)) {
                redirection('register.php?r=4');
            }

            if (empty($lastname)) {
                redirection('register.php?r=4');
            }

            if (empty($phone)) {
                redirection('register.php?r=4');
            }

            if (empty($password) OR strlen($password) < 7) {
                redirection('register.php?r=9');
            }

            if (empty($email) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                redirection('register.php?r=8');
            }

            if (empty($biography)) {
                redirection('register.php?r=8');
            }

            if (!existsUser($username)) {
                $username=$email;

                $coach = $_POST['coach'] ?? NULL;

                $fileName = "team-1.jpg";
                if($_FILES['picture']['name'] != ''){
                    $test = explode('.', $_FILES['picture']['name']);
                    $extension = end($test);    
                    $name = rand(100,999).'.'.$extension;
                
                    $location = '../uploads/'.$name;
                    move_uploaded_file($_FILES['picture']['tmp_name'], $location);
                
                    $fileName = $name;
                }

                $code = createCode(40);
                $id_user_web = registerUser($username, $password, $firstname, $lastname, $email, $code,$phone,$biography,$coach ? 3 : 2,$fileName);
                if (sendData($username, $email, $code)) {
                    redirection("index.php?r=3");
                } else {
                    addEmailFailure($id_user_web);
                    redirection("index.php?r=10");
                }

            } else {
                redirection('index.php?r=2');
            }

            break;

        case "forget" :
            $email = mysqli_real_escape_string($connection, trim($_POST["email"]));
            if (existsUser($email)) {
                $code = createCode(40);
                $expFormat = mktime(
                    date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
                    );
                
                $expDate = date("Y-m-d H:i:s",$expFormat);
                if (setCodePassword($email,$code,$expDate)) {
                    sendForgotPassword($username, $email, $code);
                    redirection("index.php?r=14");
                } else {
                    redirection("index.php?r=10");
                }

            } else {
                redirection('index.php?r=2');
            }
            break;

        default:
            redirection('index.php?l=0');
            break;
    }

} else {
    redirection('index.php?l=0');
}