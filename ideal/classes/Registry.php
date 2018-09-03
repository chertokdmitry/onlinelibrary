<?php
class Registry
{
    private  $data = array();
    
    public function __construct($data)
    {
        $this->data = $data;
    }
        
    function __get($name)
    {
	return isset($this->data[$name])?$this->data[$name]:null;
    }
    
    function __set($name, $value)
    {
	$this->data[$name] = $value;
}
}