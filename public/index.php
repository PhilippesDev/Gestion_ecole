<?php
    require_once "../core/Database.php";
    require_once "../core/Model.php";
    require_once "../core/Controller.php";
    require_once "../app/controllers/UserController.php";
    // require_once "./core/Database.php";
    // require_once "./core/Database.php"

    $usercontroller = new UserController();
    $usercontroller->displayUsers();
?>