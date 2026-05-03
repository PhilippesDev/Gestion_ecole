<?php
require_once "../app/models/Classe.php";
require_once "../app/models/Option.php";

class ClasseController extends Controller
{
    private $classe;
    private $option;

    public function __construct()
    {
        $this->classe = new Classe();
        $this->option = new Option();
    }

    public function index()
    {
        $data['classes'] = $this->classe->getAllClasses();
        $data['options'] = $this->option->getAllOptions();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("classes/list", $data);
        $this->view("layout/footer");
    }

    public function create()
    {
        $data['options'] = $this->option->getAllOptions();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("classes/create", $data);
        $this->view("layout/footer");
    }

    public function store()
    {
        if ($_POST) {
            extract($_POST);
            $this->classe->createClasse($designation, $description, $id_option);
            $_SESSION['success'] = "Classe ajoutée avec succès";
            header("Location: ?controller=classe&action=index");
            exit;
        }
    }

    public function edit($id)
    {
        $data['classe'] = $this->classe->getClasseById($id);
        $data['options'] = $this->option->getAllOptions();
        if (!$data['classe']) {
            $_SESSION['error'] = "Classe non trouvée";
            header("Location: ?controller=classe&action=index");
            exit;
        }
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("classes/edit", $data);
        $this->view("layout/footer");
    }

    public function update()
    {
        if ($_POST) {
            extract($_POST);
            $this->classe->updateClasse($id, $designation, $description, $id_option);
            $_SESSION['success'] = "Classe modifiée avec succès";
            header("Location: ?controller=classe&action=index");
            exit;
        }
    }

    public function delete($id)
    {
        $this->classe->deleteClasse($id);
        $_SESSION['success'] = "Classe supprimée avec succès";
        header("Location: ?controller=classe&action=index");
        exit;
    }

    public function students($id)
    {
        $inscription = new Inscription();
        $data['students'] = $inscription->getClassStudents($id);
        $data['classe'] = $this->classe->getClasseById($id);
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("classes/students", $data); // User can create this view
        $this->view("layout/footer");
    }
}
?>

