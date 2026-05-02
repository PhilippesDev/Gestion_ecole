<?php

require_once "../app/models/User.php";

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        $this->displayUsers();
    }

    public function displayUsers()
    {
        $data = $this->user->getAllUsers();
        $this->view("/users/list", $data);
    }

    public function searchUser()
    {
        if(isset($_GET['keyword']))
        {
            $keyword = $_GET['keyword'];
            $data = $this->user->searchUser($keyword);
            $this->view("/users/list", $data);
        }
    }

    public function addUser()
    {
        if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mot_de_passe']))
        {
            $username = $_POST['nom'];
            $email = $_POST['email'];
            $password = $_POST['mot_de_passe'];     
            $this->user->createUser($username, $email, $password);

            header("Location: ?controller=user&action=index");
        }    
    }

    public function updateUser()
    {
        if(isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['mot_de_passe']))
        {
            $id = $_POST['id'];
            $username = $_POST['nom'];
            $email = $_POST['email'];
            $password = $_POST['mot_de_passe'];     
            $this->user->updateUser($id, $username, $email, $password);

            header("Location: ?controller=user&action=index");
        }    
    }

    public function deleteUser()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $this->user->deleteUser($id);

            header("Location: ?controller=user&action=index");
        }   
    }

    public function login()
    {
        if(isset($_POST['nomOremail']) && isset($_POST['mot_de_passe']))
        {
            $usernameOremail = $_POST['nomOremail'];
            $password = $_POST['mot_de_passe'];

            if($this->user->loginUser($usernameOremail, $password))
            {
                echo "Accès Autorisé, Bienvenu";
            }
            else
            {
                echo "Le nom ou le mot de passe est incorrect !";
            }
        }    
    }
}

?>