<?php

require_once __DIR__ . "/BaseDao.class.php";

class ContactDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct('contacts');
    }
}