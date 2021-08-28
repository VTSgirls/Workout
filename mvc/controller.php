<?php
require_once 'model.php';

class Controller {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }

    public function rateCoach($data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->rateCoach($array),
        ];
        return json_encode($response);
    }

    public function updateCategory($data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->updateCategory($array),
        ];
        return json_encode($response);
    }

    public function createCategory($data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->createCategory($array),
        ];
        return json_encode($response);
    }

    public function deleteCategory($data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'body' => $this->query->deleteCategory($array),
        ];
        return json_encode($response);
    }

    public function updateUser(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateUser($array),
        ];
        
        return json_encode($response);
    }

    public function deleteExercise(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->deleteExercise($array),
        ];
        
        return json_encode($response);
    }

    public function createExercise(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->createExercise($array),
        ];
        
        return json_encode($response);
    }

    public function updateExercise(string $data) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->updateExercise($array),
        ];
        
        return json_encode($response);
    }

    public function block(string $data, $type) {
        parse_str($data,$array);
        $response = [
            'status_code_header' => 'HTTP/1.1 200 OK',
            'message' => $this->query->block($array, $type),
        ];
        
        return json_encode($response);
    }

}

?>