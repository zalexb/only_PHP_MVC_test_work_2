<?php

class Controller_Users extends Controller{

    function __construct($db){
        $this->model = new Model_Users($db);
        $this->view = new View();
    }

    public function action_login(){
        header('Content-type:application/json');
        echo json_encode($this->model->login());

    }
    public function action_logout(){
        echo $this->model->logout();
        header("location: /");

    }

}