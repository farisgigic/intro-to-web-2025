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

}