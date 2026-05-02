<?php
require_once "../app/models/Inscription.php";
require_once "../app/models/Eleve.php";
require_once "../app/models/Classe.php";
require_once "../app/models/AnneeScolaire.php";

class InscriptionController extends Controller
{
    private $inscription;
    private $eleve;
    private $classe;
    private $annee;

    public function __construct()
    {
        $this->inscription = new Inscription();
        $this->eleve = new Eleve();
        $this->classe = new Classe();
        $this->annee = new AnneeScolaire();
    }

    public function index()
    {
        $data['inscriptions'] = $this->inscription->getAllInscriptions();
        $data['eleves'] = $this->eleve->getAllEleve();
        $data['classes'] = $this->classe->getAllClasses();
        $data['annees'] = $this->annee->getAllAnneesScolaires();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("inscriptions/list", $data);
        $this->view("layout/footer");
    }

    public function create()
    {
        $data['eleves'] = $this->eleve->getAllEleve();
        $data['classes'] = $this->classe->getAllClasses();
        $data['annees'] = $this->annee->getAllAnneesScolaires();
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("inscriptions/create", $data);
        $this->view("layout/footer");
    }

    public function store()
    {
        if ($_POST) {
            $id_eleve = $_POST['id_eleve'];
            $id_classe = $_POST['id_classe'];
            $id_annee_scolaire = $_POST['id_annee_scolaire'];
            
            if ($this->inscription->createInscription($id_eleve, $id_classe, $id_annee_scolaire)) {
                $_SESSION['success'] = "Inscription créée avec succès";
            } else {
                $_SESSION['error'] = "Inscription existe déjà ou erreur";
            }
        }
        header("Location: ?controller=inscription&action=index");
        exit;
    }

    public function destroy()
    {
        if (isset($_POST['id_eleve']) && isset($_POST['id_classe']) && isset($_POST['id_annee_scolaire'])) {
            $this->inscription->deleteInscription($_POST['id_eleve'], $_POST['id_classe'], $_POST['id_annee_scolaire']);
            $_SESSION['success'] = "Inscription supprimée";
        }
        header("Location: ?controller=inscription&action=index");
        exit;
    }

    public function studentClasses($id_eleve)
    {
        $data['classes'] = $this->inscription->getStudentClasses($id_eleve);
        $data['eleve'] = $this->eleve->getAllEleve(); // Fallback if getEleveById not available
        $this->view("layout/header");
        $this->view("layout/navbar");
        $this->view("inscriptions/student_classes", $data);
        $this->view("layout/footer");
    }
}
?>

