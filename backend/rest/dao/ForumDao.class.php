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
    public function addForum($forum)
    {
        return $this->insert('forum', $forum);
    }
    public function editForum($id, $forum)
    {
        $query = "  UPDATE forum 
                    SET title = :title, description = :description, created_at = :created_at
                    WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $forum['title']);
        $stmt->bindParam(':description', $forum['description']);
        $stmt->bindParam(':created_at', $forum['created_at']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function partialUpdate($id, $forum)
    {
        return $this->update($id, $forum);
    }
}