<?php

namespace Gateway;

class Flibusta_Index {

    /**
     * @desc Возвращает обработанный запрос на получение авторов
     * @return string
     */
    public static function getAuthors ()
    {
        $sql = "SELECT id FROM authors";
        
        return \Base\Query::instance ($sql,[

        ]);
    }

    /**
     * @desc Возвращает обработанный запрос на добавление автора
     * @param integer $id ID автора
     * @return string
     */
    public static function addAuthor ($id)
    {
        $sql = "INSERT INTO authors (id) VALUES (?id)";
        
        return \Base\Query::instance ($sql,[
            'id' => (int) $id,
        ]);
    }

    /**
     * @desc Возвращает обработанный запрос на новых книг к автору
     * @param array $ids
     * @param integer $author_id
     * @return string
     */
    public static function addNewBooks ($ids, $author_id)
    {
        $sql = "INSERT INTO books (id,author_id)
        SELECT bid, aid
        FROM (
            SELECT unnest(array[?ids]) as bid, ?aid as aid
        ) a
        LEFT JOIN (
            SELECT id FROM books WHERE author_id=?aid
        ) b ON b.id=a.bid
        WHERE b.id IS NULL";
        
        return \Base\Query::instance ($sql,[
            'aid' => (int) $author_id,
            'ids' => $ids,
        ]);
    }
}
