<?php
class User extends Model
{    
    public function __construct() 
    {    
        $this->form = new Form('Login', '/user/login', ['user', 'password']);
    }
    
    public function getAuth() 
    {
        if ($_SESSION['auth']) {
            return true;
        }
        
        $_SESSION['auth'] = ($this->user=='dimas' and $this->password == '1234') ? true : false;
        return $_SESSION['auth'];
    }
}