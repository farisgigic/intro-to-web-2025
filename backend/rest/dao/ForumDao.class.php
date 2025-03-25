<?php
require_once __DIR__ . '/BaseDao.class.php';

class ForumDao extends BaseDao
{
    public function __construct()
    {
        parent::__construct('forum');
    }
}