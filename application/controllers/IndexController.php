<?php

class IndexController extends Controller
{
    public function __construct()
    {
        $this->model = new Index();
    }
    
    function index()
    {	
        $this->html .= $this->model->getAll();
        return $this->html;       
    }
}

