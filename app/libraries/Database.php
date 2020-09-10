<?php
    /**
     * PDO Database Class
     * Connect to Database
     * Create prepared Statement
     * Bind Values
     * return rows and result
     */

    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;


        public function __construct() 
        {
            $dsn = 'mysql:host=' .$this->host. ';dbname=' .$this->dbname.';charset=utf8';
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            );

            // Create PDO instance
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
                $this->dbh->exec("set names utf8");

            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }



        public  function conn()
        {
            return $this->dbh;
        }


        //Prepare statement with query
        public function query($sql)
        {
            $this->stmt = $this->dbh->prepare($sql);
        }


        //Bind values METHodu
        public function bind($param, $value, $type = null)
        {
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                       $type = PDO::PARAM_INT;
                       break;
                    case is_bool($value):
                       $type = PDO::PARAM_BOOL;
                       break;
                    case is_null($value):
                       $type = PDO::PARAM_NULL;
                       break;
                    default: 
                       $type = PDO::PARAM_STR;
                       break;   

                }
            }

            $this->stmt->bindValue($param, $value, $type);
        }


        //Execute prepared statement METHODUUU
        public function execute()
        {
            return $this->stmt->execute();
        }


        //GET result set array of object
        public function resultSet()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }


        //Tek recordu object kimi al
        public function single() 
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //GET row count
        public function rowCount()
        {
            return $this->stmt->rowCount(); 
        }


        function __destruct()
        {
            $this->disconnect();
        }

        function disconnect()
        {
            if ($this->dbh) {
                $this->dbh = null;
            }

        }
    }




?>