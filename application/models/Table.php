<?php

class Table
{
    public $html;
    
    public function __construct($name, $th = [], $tr = [])
    {   
        $this->html = $this->th($name, $th) . $this->tr($tr) . '</table>';  
    }
        
    public function th($name, $data)
    {
        $html = '<h3>' . $name . '</h3><table class="table"><thead><tr>';
      
        foreach($data as $cell) {
            $html .= '<th scope="col">' . $cell . '</th>';
        }
        $html.= '</tr>';
            return $html;
        }
        
    public function tr($data)
    {
        $html= '';
        for ($i=0; $i<sizeof($data); $i++) {
            $html .= '<tr>';
            for ($k=0; $k<sizeof($data[$i]); $k++) {
                $html .= '<td>' . $data[$i][$k] . '</td>';
            }
            $html .= '</tr>';
        }
        return $html;
    }
}
