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
    public function getForumById($id)
    {
        $query = "SELECT * FROM forum WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getForumByName($name)
    {
        $query = "SELECT * FROM forum WHERE name = :name";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function addForum($forum)
    {
        return $this->insert('forum', $forum);
    }
    public function editForum($forum_id, $forum)
    {
        $query = "UPDATE forum SET title = :title, description = :description, created_at = :created_at, user_id = :user_id WHERE forum_id = :forum_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':title', $forum['title']);
        $stmt->bindParam(':description', $forum['description']);
        $stmt->bindParam(':created_at', $forum['created_at']);
        $stmt->bindParam(':user_id', $forum['user_id']);
        $stmt->bindParam(':forum_id', $forum_id);
        return $stmt->execute();
    }
}