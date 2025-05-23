<?php
require_once __DIR__ . '/BaseDao.class.php';

class ForumDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('forum');
    }
    public function getForumByTitle($title)
    {
        $query = "SELECT * FROM forum WHERE title = :title";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $title);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function count_forums_paginated($search)
    {
        $query = "SELECT COUNT(*) AS count 
                    FROM forum
                    WHERE LOWER(title) LIKE CONCAT('%', :search, '%') OR
                    LOWER(description) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }
    public function get_forums_paginated($offset, $limit, $search, $order_column, $order_direction)
    {
        $query = "SELECT *
                  FROM forum
                  WHERE LOWER(title) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(description) LIKE CONCAT('%', :search, '%') 
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";

        return $this->query($query, [
            'search' => $search
        ]);
    }

}