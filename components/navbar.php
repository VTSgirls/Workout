<?php
// session_start();
$root = 'https://' . getenv('HTTP_HOST');


if (strpos($_SERVER['PHP_SELF'], basename(__FILE__))) {
    header("Location:$root");
}
$loggedIn = false;
$admin = false;

if (isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 1) {
    $admin = true;
}
if (isset($_SESSION['id_user'])) {
    $loggedIn = true;
    echo '<script> sessionStorage.setItem("id", "' . $_SESSION['id_user'] . '");</script>';
}
?>

<div class="cover">
    <div class="co">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-md-end">
                <div class="reg">
                    <?php
                    if ($loggedIn) {
                        $adminPage = "$root/login/logout.php";
                        echo "
                            <a href='$adminPage'>Log Out</a>
                            ";
                    } else {
                        $registerPage = "$root/login/";
                        echo "
                            <a href='$registerPage' class='mr-2 mb-0'>Sign-Up | Log In</a>
                            ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="header">
    <div class="menu-bar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #333;">
                    <ul class="navbar-nav flex-fill justify-content-end align-items-center">  
                        <li class="nav-item">
                            <a href="<?php echo $root . '/'; ?>" class="nav-link">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $root . '/coaches.php'; ?>" class="nav-link">COACHES</a>
                        </li>
                        <?php
                            if ($loggedIn) {
                                $profilePage = "$root/profile/";
                                $exercisesPage =  $root.'/exercises.php';
                                echo "
                                <li class='nav-item'>
                                    <a href='$exercisesPage' class='nav-link'>EXERCISES</a>
                                </li>
                                <li class='nav-item'>
                                    <a href='$profilePage' class='nav-link'>PROFILE</a>
                                </li>
                                ";
                            }
                            if ($admin) {
                                $adminPage = "$root/admin_page.php";
                                echo "
                                <li class='nav-item'>
                                    <a href='$adminPage'class='nav-link'>ADMIN</a>
                                </li>
                                ";
                            }
                        ?>
                        <form action="search.php" method="post">
                            <input type="text" placeholder="Search.." name="query">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</section>