<?php
require_once __DIR__ . "/BaseService.class.php";
require_once __DIR__ . "/../dao/ForumDao.class.php";

class ForumService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new ForumDao());
    }

    public function getAllForums()
    {
        return $this->dao->get_all();
    }

    public function getForumById($forum_id)
    {
        $forum = $this->dao->get_by_id($forum_id);
        if (!$forum) {
            throw new Exception("Forum with ID $forum_id does not exist.");
        }
        return $forum;
    }
    public function getForumByTitle($title)
    {
        return $this->dao->getForumByTitle($title);
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
        return $this->dao->add($forumData);
    }

    public function editForum($id, $forum)
    {
        $existingID = $this->dao->get_by_id($id);
        if (!$existingID) {
            throw new Exception("Forum with this ID does not exist.");
        }
        return $this->dao->update($id, $forum);
    }

    public function deleteForum($forum_id)
    {
        $existingForum = $this->dao->get_by_id($forum_id);
        if (!$existingForum) {
            throw new Exception("Forum with this ID does not exist.");
        }
        return $this->dao->delete($forum_id);
    }
}