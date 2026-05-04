    <?php
    class Controller
    {
        public function view($page, $data = [])
        {
            require './app/views' .$page. 'php';
        }
    }

?>
