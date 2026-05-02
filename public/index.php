<?php
require_once "../app/config/config.php";
require_once "../core/Database.php";
require_once "../core/Model.php";
require_once "../core/Controller.php";

// Load all controllers
require_once "../app/controllers/UserController.php";
require_once "../app/controllers/EleveController.php";
require_once "../app/controllers/ClasseController.php";
require_once "../app/controllers/InscriptionController.php";

// Load all models
require_once "../app/models/Eleve.php";
require_once "../app/models/Classe.php";
require_once "../app/models/Option.php";    
require_once "../app/models/AnneeScolaire.php";
require_once "../app/models/Inscription.php";

// Simple router
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClass = ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();

    if (method_exists($controller, $actionName)) {
        if (isset($_GET['id'])) {
            $controller->$actionName($_GET['id']);
        } else {
            $controller->$actionName();
        }
    } else {
        echo "Action '$actionName' not found in $controllerClass";
    }
} else {
    echo "Controller '$controllerClass' not found";
}