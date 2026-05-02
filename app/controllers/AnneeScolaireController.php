<?php

    require_once "../app/models/AnneeScolaire.php";

    class AnneeScolaireController extends Controller
    {
        private $annee_scolaire;

        public function __construct() {
            $this->annee_scolaire = new AnneeScolaire();
        }

        public function displayAnneeScolaire(){
            $data = $this->annee_scolaire->getAllAnneesScolaires();
            $this->view("/annee_scolaire/list", $data);
        }

        public function searchAnneeScolaire()
        {
            if(isset($_GET['keyword']))
            {
                $keyword = $_GET['keyword'];
                $data = $this->annee_scolaire->searchAnneeScolaire($keyword);
                $this->view("/annee_scolaire/list", $data);
            }
        }

        public function addAnneeScolaire()
        {
            if(isset($_POST['designation']))
            {
                $designation = $_POST['designation'];  
                $this->annee_scolaire->createAnneeScolaire($designation);
            }    
        }

        public function updateAnneeScolaire()
        {
            if(isset($_POST['id']) && isset($_POST['designation']))
            {
                $id = $_POST['id'];
                $designation = $_POST['designation'];
                $this->annee_scolaire->updateAnneeScolaire($id,$designation);
            }    
        }
        
        public function deleteAnneeScolaire()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                $this->annee_scolaire->deleteAnneeScolaire($id);
            }   
        }
    }
?>