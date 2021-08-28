<?php
define("SITE", "https://vtsgirls.proj.vts.su.ac.rs/login");
define("HOST", "localhost");
define("USER", "vtsgirls");
define("PASSWORD", "bq5z#6Q@tjd9");
define("DATABASE", "vtsgirls");
define("SECRET", "");

$actions = ['login', 'register', 'forget'];

$messages = [
    0 => 'No direct access!',
    1 => 'Unknown user!',
    2 => 'User with this name already exists, choose another one!',
    3 => 'Check your email to active your account!',
    4 => 'Fill all the fields!',
    5 => 'You are logged out!!',
    6 => 'Your account is activated, you can login now!',
    7 => 'Passwords are not equal!',
    8 => 'Format of e-mail address is not valid!',
    9 => 'Password is too short! It must be minimum 8 characters long!',
    10 => 'Something went wrong with mail server. We will try to send email later!',
    11 => 'Your account is already activated!',
    12 => 'Your account is has been updated!',
    13 => 'Your account is has been updated!',
    14 => 'Check your e-mail inbox!',
];
