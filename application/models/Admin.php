<?php

class Admin extends Model
{
    const DATA = ['books' => ['id', 'title', 'author_id'], 'authors' => ['id', 'first', 'last']];
    
    public function getAllBooks() 
    {
        $tr = [];
        $i = 0;
        $data = \R::findAll('books');      

        foreach ($data as $value) {
            $author = \R::findOne('authors', ' id = ?', [$value['author_id']]);    
            $tr[$i][0] = '<a href="/admin/delete/books/' . $value['id'] . '"><button type="button" class="btn btn-danger"> X </button></a>';
            $tr[$i][1] = '<a href="/admin/update/books/' . $value['id'] . '"><button type="button" class="btn btn-info"> update </button></a>';
            $tr[$i][2] =  $value['id'];
            $tr[$i][3] = $value['title'];
            $tr[$i][4] = $author['first'] . ' ' . $author['last'] . ' (id: ' . $author['id'] . ')';
            $i++;
        }
        
        $button = ['<a href="/admin/add/books"><button type="button" class="btn btn-warning">+ add</button></a>', ' '];
        $rows = array_merge($button, self::DATA['books']);
        $table = new Table('Books', $rows, $tr);
        return $table->html;
    }
    
    public function getAllAuthors() 
    {
        $tr = [];
        $i = 0;
        $data = \R::findAll('authors'); 

        foreach ($data as $value) {
            
            $booksAmount = \R::count('books', ' author_id = ?', [$value['id']]);    
            
            $tr[$i][0] = '<a href="/admin/delete/authors/' . $value['id'] . '"><button type="button" class="btn btn-danger"> X </button></a>';
            $tr[$i][1] = '<a href="/admin/update/authors/' . $value['id'] . '"><button type="button" class="btn btn-info"> update </button></a>';
            $tr[$i][2] = $value['id'];
            $tr[$i][3] = $value['first'];
            $tr[$i][4] = $value['last'];
            $tr[$i][5] = $booksAmount;
            $i++;}
        
        $button = ['<a href="/admin/add/authors"><button type="button" class="btn btn-warning">+ add</button></a>', ' '];
        $rows = array_merge($button, self::DATA['authors']);
        $rows[] = 'books amount';
        $table = new Table('Authors', $rows, $tr);
        return $table->html;
    }
    
    public function delete($table, $id) 
    {
        $item = \R::load($table, $id );
        \R::trash($item);
        return true;
    }
    
    public function makeForm($action, $table, $id) 
    {   
        $header = '<h3>' . $action . ' item</h3>';
        $formAction = '/admin/' . $action . '/' .  $table;
        $tr = new Form($header, $formAction, self::DATA[$table], $id);
        return $tr->html;
    }
    
    public function update($table, $data) 
    {    
        $html = '';
        $item = \R::findOne($table, ' id = ?', [$_POST['hidden_id']]); 
           
        foreach($data as $key=>$value) {
            if(!empty($_POST[$key] && $key!='hidden_id')) {
            $item->$key = $value;
        $html .= 'Updated: ' . $key . ' value: ' .$value . '<br><br>'; }
        }
        \R::store($item);
        return $html;
    }
    
    public function add($table, $data) 
    {    
        $html = '';
        $item = \R::dispense($table);

        foreach($data as $key=>$value){
            if(!empty($_POST[$key] && $key!='hidden_id' && $key!='id')) {
            $item->$key = $value;
            $html .= 'Added: ' . $key . ' value: ' .$value . '<br><br>'; }
        }
        \R::store($item);
        return $html;
    }
}
