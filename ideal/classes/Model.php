<?php

class Model{
  private $_data = null;
 
  function __construct() {
    $this->_data = new stdClass();
  }
  function __set($name, $value) {
    if ($name==='__attributes') {
      foreach ($value as $key=>$value) {
        $this->__set($key, $value);
      }
      return;
    }
    if (method_exists($this, 'set'.$name)) {
      return call_user_func(array($this,'set'.$name), $value);
    }
    return $this->_data->$name = $value;
  }
  function __get($name) {
    if ($name==='__attributes') {
      return $this->_data;
    }
    if (method_exists($this, 'get'.$name)) {
      return call_user_func(array($this,'get'.$name));
    }
    return property_exists($this->_data, $name) ? $this->_data->$name : null;
  }
  
    function __call($methodName, $args=array()){
		if(is_callable(array($this, $methodName))) {
			return call_user_func_array(array($this, $methodName), $args);
                } else {
		throw new Except('In controller '.get_called_class().' method '.$methodName.' not found!');
                }
	}
}
