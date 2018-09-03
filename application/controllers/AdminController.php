<?php

class AdminController extends Controller
{   
    public $html;
    public function __construct()
    {
        $this->model = new Admin();
    }
  
    public function index()
    {
        return $this->html;
    }
    
    public function viewall()
    {
        $action = 'getAll' . ucfirst(App::gi()->uri->table);
        $this->html .= $this->model->__call($action);
        return $this->html;
    }
    
    public function delete()
    {
        if($this->model->delete(App::gi()->uri->table, App::gi()->uri->id)) {
            $this->html .= "Success<br><br>";
        } else {
             $this->html .= "Error!<br><br>";
        }
        
        $action = 'getAll' . ucfirst(App::gi()->uri->table);
        $this->html .= $this->model->__call($action);
        return $this->html; 
    }
    
    public function update()
    {
       if (!empty($_POST)) {
            $this->html .= $this->model->update(App::gi()->uri->table, $_POST);
       } else {
            $this->html .= $this->model->makeForm('update', App::gi()->uri->table, App::gi()->uri->id);
       }  
        return $this->html;
    }
    
    public function add()
    {
       if (!empty($_POST)) {
            $this->html .= $this->model->add(App::gi()->uri->table, $_POST);
       } else {
             $this->html .= $this->model->makeForm('add', App::gi()->uri->table, ' ');
       }
       return $this->html;
    }
}