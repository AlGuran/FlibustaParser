<?php

class Parser_Flib {
    
    public static function index()
    {
        $query = \Gateway\Flibusta_Index::getAuthors();
        $result = \Base\Db::query($query);
        
        foreach (\Base\Db::_assoc($result) as $row){
            $author_id = $row['id'];
            
            $url = 'http://flibusta.is/a/'.$author_id;
            $html = \Base\Curl::index($url);
            
            preg_match_all('/"\/b\/(\d+)\/read"/', $html, $matches, PREG_OFFSET_CAPTURE);
            
            foreach($matches[1] as $i){
                $ids[] = $i[0];
            }
            
            $query = \Gateway\Flibusta_Index::addNewBooks($ids, $author_id);
            \Base\Db::query($query);
        }
    }
    
    public static function addAuthorId($param){
        $query = \Gateway\Flibusta_Index::addAuthor($param['id']);
                
        \Base\Db::query($query);
    }
}

