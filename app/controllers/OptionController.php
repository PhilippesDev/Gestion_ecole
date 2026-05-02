<?php
require_once "../app/models/Option.php";

class OptionController extends Controller
{
    private $option;

    public function __construct()
    {
        $this->option = new Option();
    }

    public function index()
    {
        $data['options'] = $this->option->getAllOptions();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("options/list", $data);
        $this->view("layout/footer");
    }

    public function create()
    {
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("options/create");
        $this->view("layout/footer");
    }

    public function store()
    {
        if (isset($_POST['designation']) && isset($_POST['code'])) {
            $this->option->createOption($_POST['designation'], $_POST['code']);
            $_SESSION['success'] = "Option ajoutée";
            header("Location: ?controller=option&action=index");
            exit;
        }
    }

    public function edit($id)
    {
        $data['options'] = $this->option->getAllOptions();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("options/edit", $data);
        $this->view("layout/footer");
    }

    public function update()
    {
        if (isset($_POST['id']) && isset($_POST['designation']) && isset($_POST['code'])) {
            $this->option->updateOption($_POST['id'], $_POST['designation'], $_POST['code']);
            $_SESSION['success'] = "Option modifiée";
            header("Location: ?controller=option&action=index");
            exit;
        }
    }

    public function delete($id)
    {
        $this->option->deleteOption($id);
        $_SESSION['success'] = "Option supprimée";
        header("Location: ?controller=option&action=index");
        exit;
    }
}
?>

