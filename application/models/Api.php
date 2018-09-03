<?php

class Api 
{
    function getItem($table, $id)
    {
	header("HTTP/1.1 200");
	$item = \R::findOne($table, ' id = ?', [$id]); 
        $author = \R::findOne('authors', ' id = ?', [$item['author_id']]); 
	$response['status']= '200';
	$response['status_message']='Item found';
	$response['title']= $item['title'];
        $response['author']= $author['first'] . ' ' . $author['last'];
	$json_response = json_encode($response);
	return $json_response;
    }
    
    function getAll($table)
    {
        $data = '';
        $items = \R::findAll($table); 
        $data .= '{"books":[';
        foreach ($items as $item) {
            $author = \R::findOne('authors', ' id = ?', [$item['author_id']]);    
            $data .= '{"id":"' . $item['id'] . 
                    '", "title":"' . $item['title'] .
                    '", "author":"' . $author['first'] . ' ' . $author['last'] . '"},';
        }
        $data .= ']';
        return $data;
    }
    
    function delete($table, $id) 
    {
        $item = \R::load($table, $id );
        \R::trash($item);
        return true;
    }
    
    public function update($table, $data) 
    {    
        $html = '';
        $item = \R::findOne($table, ' id = ?', [$_POST['id']]); 
           
        foreach($data as $key=>$value) {
            if(!empty($_POST[$key] && $key!='id')) {
            $item->$key = $value;
        $html .= 'Updated: ' . $key . ' value: ' .$value . '<br><br>'; }
        }
        \R::store($item);
        return $html;
    }
}
