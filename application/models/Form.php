<?php

class Form 
{
    public $html;
    
    public function __construct($header, $action, $fields = [], $id = 0)
    {
        $this->html = '<h3>' . $header . '</h3>';
        $this->html .= '<br><br><form action="' . $action . '" method="post">';
        if($fields[0] == 'id') unset($fields[0]);
        foreach ($fields as $field) {
            $this->html .= '<br><br><div class="form-group">
                        <label for="' . $field . '">' . $field . '</label>
                        <input type="text" class="form-control" id="' . $field . '" name="' . $field . '" placeholder=" ' . $field . '">
                      </div>';
        }
        $this->html .= '<input type="hidden" name="hidden_id" value="' . $id . '">'
                . '<button type="submit" class="btn btn-primary">Submit</button></form>';
    }
}
