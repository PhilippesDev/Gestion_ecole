<?php
require_once "../app/models/Eleve.php";

class EleveController extends Controller
{
    private $eleve;

    public function __construct()
    {
        $this->eleve = new Eleve();
    }

    public function index()
    {
        /*
        $data['eleves'] = $this->eleve->getAllEleve();

        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("eleves/list", $data);
        $this->view("layout/footer");
        */


    $data = $this->eleve->getAllEleve();

    var_dump($data);
    die();

    }

    public function search()
    {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $data['eleves'] = $this->eleve->searchEleve($keyword);
        } else {
            $data['eleves'] = [];
        }

        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("eleves/list", $data);
        $this->view("layout/footer");
    }

    public function create()
    {
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("eleves/create");
        $this->view("layout/footer");
    }

    public function store()
    {
        if ($_POST) {
            extract($_POST);

            $this->eleve->createEleves(
                $nom, $postnom, $prenom, $sexe,
                $date_naissance, $lieu_naissance,
                $noms_pere, $noms_mere,
                $adresse, $contact_pere, $contact_mere
            );

            $_SESSION['success'] = "Élève ajouté avec succès";
            header("Location: ?controller=eleve&action=index");
            exit;
        }
    }

    public function edit($id)
    {
        $data['eleve'] = $this->eleve->getEleveById($id);

        if (!$data['eleve']) {
            $_SESSION['error'] = "Élève non trouvé";
            header("Location: ?controller=eleve&action=index");
            exit;
        }

        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("eleves/edit", $data);
        $this->view("layout/footer");
    }

    public function update()
    {
        if ($_POST) {
            extract($_POST);

            $this->eleve->updateEleve(
                $id, $nom, $postnom, $prenom, $sexe,
                $date_naissance, $lieu_naissance,
                $noms_pere, $noms_mere,
                $adresse, $contact_pere, $contact_mere
            );

            $_SESSION['success'] = "Élève modifié avec succès";
            header("Location: ?controller=eleve&action=index");
            exit;
        }
    }

    public function delete($id)
    {
        $this->eleve->deleteEleve($id);

        $_SESSION['success'] = "Élève supprimé avec succès";
        header("Location: ?controller=eleve&action=index");
        exit;
    }
}
?>