<?php
    class Controller
    {
        public function view($file, $data = [])
        {
            require "../app/views/$file.php";
        }
    }
?>