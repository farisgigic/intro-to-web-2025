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
        $forum = $this->forumDao->getForumById($forum_id);
        if (!$forum) {
            throw new Exception("Forum with ID $forum_id does not exist.");
        }
        return $forum;
    }
    public function getForumByTitle($title)
    {
        return $this->forumDao->getForumByTitle($title);
    }

    public function addForum($forumData)
    {
        // Validate required fields
        $requiredFields = ['title', 'description', 'user_id'];
        foreach ($requiredFields as $field) {
            if (!isset($forumData[$field]) || empty(trim($forumData[$field]))) {
                throw new Exception("Field '$field' is required and cannot be empty.");
            }
        }
        return $this->forumDao->addForum($forumData);
    }

    public function editForum($id, $forum)
    {
        $existingID = $this->forumDao->getForumById($id);
        if (!$existingID) {
            throw new Exception("Forum with this ID does not exist.");
        }
        return $this->forumDao->editForum($id, $forum);
    }

    public function deleteForum($forum_id)
    {
        $existingForum = $this->forumDao->getForumById($forum_id);
        if (!$existingForum) {
            throw new Exception("Forum with this ID does not exist.");
        }
        return $this->forumDao->deleteForum($forum_id);
    }
}