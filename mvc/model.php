<?php
require_once __DIR__.'/../db.php';
require_once __DIR__.'/../login/functions_def.php';

class Model {

    private $connection;

    function __construct() {
        $this->connection = DB::connect();
    }

    public function search() {

        if(sizeof($_REQUEST)){
            $sql = "SELECT *, exercises.id as ex_id FROM exercises LEFT JOIN category on category.id = exercises.category WHERE `exercise_name` like '%$_REQUEST[query]%' ORDER BY exercises.rating_sum DESC";
        }else{
            $sql = "SELECT *, exercises.id as ex_id FROM exercises LEFT JOIN category on category.id = exercises.category ORDER BY exercises.rating_sum DESC";
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function coaches() {
        $sql = "SELECT * FROM `trainers` LEFT JOIN users ON users.id_user = trainers.id";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function rateCoach($data) {
        $sql = "UPDATE `trainers` SET rating_sum = rating_sum + $data[value] , rating_count = rating_count + 1 WHERE id = $data[id]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "Success";
    }

    public function updateCategory(array $data) {

        $sql = "UPDATE `category` SET `category_name` = '$data[name]' WHERE `category_name` = '$data[old]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "success";
    }

    public function deleteCategory(array $data) {

        $sql = "DELETE FROM `category` WHERE `category_name` = '$data[old]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "success";
    }

    public function createCategory(array $data) {

        $sql = "INSERT INTO `category` (`category_name`) VALUES ('$data[name]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return "success";
    }

    public function getUserData() {

        $sql = "SELECT * FROM `users` WHERE `users`.`id_user` = $_SESSION[id_user]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserTrainings() {

        $sql = "SELECT *, exercises.id as ex_id FROM `exercises` LEFT JOIN category on category.id = exercises.category WHERE `owner` = $_SESSION[id_user]";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllTrainings() {

        $sql = "SELECT *, exercises.id as ex_id FROM `exercises` LEFT JOIN category on category.id = exercises.category";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function users() {

        $sql = "SELECT * FROM users LEFT JOIN trainers ON users.id_user = trainers.id LEFT JOIN user_types ON users.user_type = user_types.ut_id WHERE users.user_type != '1'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories() {

        $sql = "SELECT * FROM `category`";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function block($data, $type) {
        $active = "";
        $sql = "";

        if($type == "user"){
            $active = "SELECT `active` FROM `users` WHERE `id_user` = '$data[id]'";
        }else if($type == "exercise") {
            $active =  "SELECT `active` FROM `exercises` WHERE `id` = '$data[id]'";
        } else{
            $active = "SELECT `active` FROM `trainers` WHERE `id` = '$data[id]'";
        }

        $result = mysqli_query($this->connection, $active) or die(mysqli_error($this->connection));     
        $active = $result->fetch_all(MYSQLI_ASSOC);

        $message = "";
        if($active[0]['active'] == 0) {
            $active = 1;
            $message = "The $type has been unblocked.";
        }else{
            $active = 0;
            $message = "The $type has been blocked.";
        }

        if($type == "user"){
            $sql = "UPDATE `users` SET `active` = '$active' WHERE `users`.`id_user` = '$data[id]'";
        }else if($type == "exercise"){
            $sql = "UPDATE `exercises` SET `active` = '$active' WHERE `id` = '$data[id]'";
        }else {
            $sql = "UPDATE `trainers` SET `active` = '$active' WHERE `trainers`.`id` = '$data[id]'";
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));     

        return $message;
    }

    public function updateUser(array $data) {
        $sql = '';

        if(isset($data['password'])){
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `password` = '$password' WHERE `users`.`id_user` = $_SESSION[id_user]";
        }else if(isset($data['biography'])){
            $sql = "UPDATE `users` SET `firstname` = '$data[firstname]', `lastname` = '$data[lastname]', `phone` = '$data[phone]', `biography` = '$data[biography]' WHERE `users`.`id_user` = $_SESSION[id_user]";
        } else{
            $sql = "UPDATE `users` SET `firstname` = '$data[firstname]', `lastname` = '$data[lastname]', `phone` = '$data[phone]' WHERE `users`.`id_user` = $_SESSION[id_user]"; 
        }

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return $result ? 'Updated successfully.' : 'There was an error.';
    }

    public function deleteExercise(array $data) {

        $sql = "DELETE FROM `exercises` WHERE `id` = '$data[id]'";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return "Success";
    }

    public function createExercise(array $data) {

        $sql = "INSERT INTO `exercises`(`description`, `exercise_duration`, `video_link`, `owner`, `exercise_name`, `category`) VALUES ('$data[desc]','$data[ex_duration]','$data[video]','$_SESSION[id_user]','$data[ex_name]', '$data[category]')";

        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return "Success";
    }

    public function updateExercise(array $data) {

        if($data['description']){
            $sql = "UPDATE `exercises` SET `description`='$data[description]',`exercise_duration`='$data[exercise_duration]',`exercise_name`='$data[exercise_name]'  WHERE id = '$data[id]'";
        }else{
            $sql = "UPDATE `exercises` SET `rating_sum`= rating_sum + 1  WHERE id = '$data[id]'";
        }


        $result = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        
        return "Success";
    }
    
}

?>

