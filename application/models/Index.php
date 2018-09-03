<?php

class Index extends Model
{
    const DATA = ['book_id', 'title', 'author_id', 'first', 'last'];
        
    public function getAll() 
    {
        $tr = [];
        $i = 0;
        $books = \R::findAll('books');   

        foreach ($books as $book) {
            $author = \R::findOne('authors', ' id = ?', [$book['author_id']]);    
            $tr[$i][0] = $book['id'];
            $tr[$i][1] = $book['title'];
            $tr[$i][2] =  $author['id'];
            $tr[$i][3] = $author['first'];
            $tr[$i][4] = $author['last'];
            $i++;
        }
        
        $table = new Table('Online library',  self::DATA, $tr);
        return $table->html;
    }
}
