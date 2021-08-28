<?php
require_once "model.php";

class View {

    private $query;
    
    function __construct() {
        $this->query = new Model();
    }

    public function search() {
        $renderData = $this->query->search();

        return $renderData;
    }

    public function coaches() {
        $renderData = $this->query->coaches();

        return $renderData;
    }

    public function getUserData() {
        $renderData = $this->query->getUserData();

        return $renderData;
    }

    public function getUserTrainings() {
        $renderData = $this->query->getUserTrainings();

        return $renderData;
    }

    public function users() {
        $renderData = $this->query->users();

        return $renderData;
    }

    public function getCategories() {
        $renderData = $this->query->getCategories();

        return $renderData;
    }

    public function getAllTrainings() {
        $renderData = $this->query->getAllTrainings();

        return $renderData;
    }

}

?>