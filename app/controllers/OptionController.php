<?php

    require_once "../app/models/Option.php";

    class OptionController extends Controller
    {
        private $option;

        public function __construct() {
            $this->option = new Option();
        }

        public function displayOptions(){
            $data = $this->option->getAllOptions();
            $this->view("/options/list", $data);
        }

        public function searchOption()
        {
            if(isset($_GET['keyword']))
            {
                $keyword = $_GET['keyword'];
                $data = $this->option->searchOption($keyword);
                $this->view("/options/list", $data);
            }
        }

        public function addOption()
        {
            if(isset($_POST['designation']) && isset($_POST['code']))
            {
                $designation = $_POST['designation'];
                $code = $_POST['code'];  
                $this->option->createOption($designation, $code);
            }    
        }

        public function updateOption()
        {
            if(isset($_POST['id']) && isset($_POST['designation']) && isset($_POST['code']))
            {
                  $id = $_POST['id'];
                $designation = $_POST['designation'];
                $code = $_POST['code'];  
                $this->option->updateOption($id,$designation, $code);
            }    
        }
        
        public function deleteOption()
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                $this->option->deleteOption($id);
            }   
        }
    }
?>