<?php
require_once __DIR__ . "/../dao/ForumDao.class.php";

class ForumService
{
    protected $forumDao;

    public function __construct()
    {
        $this->forumDao = new ForumDao();
    }

    public function getAllForums()
    {
        return $this->forumDao->getAllForums();
    }

    public function getForumById($forum_id)
    {
        return $this->forumDao->getForumById($forum_id);
    }
    public function getForumByTitle($title)
    {
        return $this->forumDao->getForumByTitle($title);
    }

    public function addForum($forum)
    {
        return $this->forumDao->addForum($forum);
    }

    public function editForum($id, $forum)
    {
        return $this->forumDao->editForum($id, $forum);
    }

    public function deleteForum($forum_id)
    {
        return $this->forumDao->deleteForum($forum_id);
    }
}