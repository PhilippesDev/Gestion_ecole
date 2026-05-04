    <?php
    class Database{

        public $connection;

        public function connect()
        {
             $this->connection = new PDO("mysql:host=localhost; dbname=gestion_ecole", "root", "");
            return $this->connection;
        }
    }
   ?>
