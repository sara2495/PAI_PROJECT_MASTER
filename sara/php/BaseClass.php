<?php

require_once __DIR__ . "/DB.php";

class BaseClass {

    private $db;

    function __construct()
    {
        $dbObject = new DB();
        $this->db = $dbObject->getPdo();
    }

    public function getDb()
    {
        return $this->db;
    }


}