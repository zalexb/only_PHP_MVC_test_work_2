<?php

class Controller_Tasks extends Controller{

    function __construct($db){
        $this->model = new Model_Tasks($db);
        $this->view = new View();
    }


    public function action_index(){
        if(!empty($_GET['sort']))
            $sort_by = $_GET['sort'];
        $data = $this->model->get(3,'/',$sort_by);
        $this->view->generate('main_view.php', './templates/template_view.php',$data);
    }

    public function action_create(){
        $this->model->create();
        header("location: /");

    }
    public function action_status(){
        $this->model->status_change();

    }
    public function action_content(){
        header('Content-type:application/json');
        echo json_encode($this->model->content_change());
    }
}