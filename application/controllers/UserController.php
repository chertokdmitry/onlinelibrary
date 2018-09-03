<?php

class UserController extends Controller
{
    public function __construct()
    {
  
        $this->model = new User();
    }
    
    function index()
    {

        return $this->model->form->html;
    }
    
    function login()
    {
        if (isset($_POST['user'])) {
            $this->model->__attributes = $_POST;
            if($this->model->getAuth()){
                header('Location:/admin');
            } else {
                header('Location:/user');
            }
       }
    }
}