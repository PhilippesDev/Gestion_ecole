<?php

require_once "Database.php";

class Model
{
    public $db;

    public function  __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }
}
