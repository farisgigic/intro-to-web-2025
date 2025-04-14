<?php
require_once __DIR__ . '/BaseDao.class.php';

class ForumDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('forum');
    }
    public function getAllForums()
    {
        $query = "SELECT * FROM forum";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getForumById($forum_id)
    {
        $query = "SELECT * FROM forum WHERE forum_id = :forum_id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        return $stmt->fetch();
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
    public function editForum($forum_id, $forum)
    {
        $query = "  UPDATE forum 
                    SET title = :title, description = :description, created_at = :created_at
                    WHERE forum_id = :forum_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $forum['title']);
        $stmt->bindParam(':description', $forum['description']);
        $stmt->bindParam(':created_at', $forum['created_at']);
        $stmt->bindParam(':forum_id', $forum_id);
        return $stmt->execute();
    }

    public function partialUpdate($id, $forum)
    {
        return $this->update($id, $forum);
    }
    public function deleteForum($forum_id)
    {
        $query = "DELETE FROM forum WHERE forum_id = :forum_id";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':forum_id', $forum_id);
        return $stmt->execute();
    }
}