<?php
require_once "./core/Database.php";

class Model
{
    public $db;

    public function  __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }
}
