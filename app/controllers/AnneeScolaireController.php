<?php
require_once "../app/models/AnneeScolaire.php";

class AnneeScolaireController extends Controller
{
    private $annee;

    public function __construct()
    {
        $this->annee = new AnneeScolaire();
    }

    public function index()
    {
        $data['annees'] = $this->annee->getAllAnneesScolaires();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("annees/list", $data);
        $this->view("layout/footer");
    }

    public function create()
    {
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("annees/create");
        $this->view("layout/footer");
    }

    public function store()
    {
        if (isset($_POST['designation'])) {
            $this->annee->createAnneeScolaire($_POST['designation']);
            $_SESSION['success'] = "Année scolaire ajoutée";
            header("Location: ?controller=anneescolaire&action=index");
            exit;
        }
    }

    public function edit($id)
    {
        $data['annee'] = $this->annee->getAllAnneesScolaires(); // Fallback
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("annees/edit", $data);
        $this->view("layout/footer");
    }

    public function update()
    {
        if (isset($_POST['id']) && isset($_POST['designation'])) {
            $this->annee->updateAnneeScolaire($_POST['id'], $_POST['designation']);
            $_SESSION['success'] = "Année scolaire modifiée";
            header("Location: ?controller=anneescolaire&action=index");
            exit;
        }
    }

    public function delete($id)
    {
        $this->annee->deleteAnneeScolaire($id);
        $_SESSION['success'] = "Année scolaire supprimée";
        header("Location: ?controller=anneescolaire&action=index");
        exit;
    }
}
?>

