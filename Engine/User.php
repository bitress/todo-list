<?php

class User
{

    private Database $db;
    public int $userId;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function changePassword()
    {

    }

}