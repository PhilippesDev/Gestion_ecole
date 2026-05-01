<?php

    require_once "../app/models/User.php";

    class UserController extends Controller
    {
        private $user;

        public function __construct()
        {
            $this->user = new User();
        }

        public function displayUsers()
        {
            $data = $this->user->getAllUsers();
            $this->view("/users/list", $data);
        }
    }

?>