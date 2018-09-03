<?php

class ApiController extends Controller 
{
    public function view()
    {
       $this->model = new Api;
       return $this->model->getItem(App::gi()->uri->table, App::gi()->uri->id);
    }
    
    public function all()
    {
       $this->model = new Api;
       return $this->model->getAll(App::gi()->uri->table);
    }
    
    public function delete()
    {
        $this->model = new Api;
        if($this->model->delete(App::gi()->uri->table, App::gi()->uri->id)) {
            $this->html = "Success!";
        } else {
            $this->html = "Error!";
        }
        return $this->html; 
    }
    
    public function update()
    {
       if (!empty($_POST)) {
            $this->html .= $this->model->update(App::gi()->uri->table, $_POST);
       } 
        echo $this->html;
    }
    
}
