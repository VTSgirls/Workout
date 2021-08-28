<?php

include 'login/config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['firstname'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $phonenumber = md5($_POST['phonenumber']);
    $biography = md5($_POST['biography']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM trainers WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO trainers (firstname, lastname, password, phonenumber, biography)
					VALUES ('$firstname', '$lastname', '$password', '$phonenumber', '$biography')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('User Registration Completed.')</script>";
                $firstname = "";
                $lastname = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                $phonenumber = "";
                $biography = "";
            } else {
                echo "<script>alert('Woops! Something went wrong.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email already exists.')</script>";
        }

    } else {
        echo "<script>alert('Password not matched.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="trainer_page.css">

    <title>Trainer page</title>
</head>
<body>
<div class="container">
    <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Change profile</p>
        <div class="input-group">
            <input type="text" placeholder="First name" name="firstname" value="<?php echo $firstname; ?>" required>
        </div>
        <div class="input-group">
            <input type="text" placeholder="Last name" name="lastname" value="<?php echo $lastname; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Old password" name="oldpassword" value="<?php echo $_POST['oldpassword']; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="New password" name="password" value="<?php echo $password; ?>" required>
        </div>
        <div class="input-group">
            <input type="password" placeholder="Confirm password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
        </div>
        <div class="input-group">
            <input type="number" placeholder="Phone number" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
        </div>
        <div class="input-group" id="biography">
            <input type="text" placeholder="Biography" name="biography" value="<?php echo $biography; ?>" required>
        </div>
        <div class="input-group">
            <button name="change" class="btn">Change profile</button>
        </div>
    </form>
</div>
<div class="programs_exercises">
    <h1 id="welcome">Welcome trainer!</h1>
    <div class="programs">
        <ul>TRAINING PROGRAMS:
        <li>Training for beginners</li>
        <li>Weight loss</li>
        <li>Increase in muscle mass</li>
        <li>Increase in fitness</li><br>
        <div class="input-group" id="add_program">
            <input type="text" placeholder="New training program" name="program">
        </div><br></ul><br>
        <div class="input-group">
            <button type="submit" name="add" class="btn" style="width: 60px">Add</button>
            <button type="button" name="change" class="btn" style="width: 60px">Change</button>
            <button type="reset" name="delete" class="btn" style="width: 60px">Delete</button>
        </div>
    </div><br><br>
    <div class="exercises">
        <ul id="exercises">EXERCISES:
        <li>Chest</li>
        <li>Shoulders</li>
        <li>Biceps</li>
        <li>Triceps</li>
        <li>Forearms</li>
        <li>Abdomen</li>
        <li>Back</li>
        <li>Thighs</li>
        <li>Calves</li><br>
        <div class="input-group" id="add_exercise">
            <input type="text" placeholder="New exercise" name="exercise">
        </div><br></ul><br>
        <div class="input-group">
            <button name="add" class="btn" style="width: 60px">Add</button>
            <button name="change" class="btn" style="width: 60px">Change</button>
            <button name="delete" class="btn" style="width: 60px">Delete</button>
        </div>
    </div>
</div>
</body>
</html>