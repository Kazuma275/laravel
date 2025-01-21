<?php

    class PDOConnection implements DatabaseConnectorInterface
    {
        private PDO $pdo ;
        private PDOStatement $pdop ;

        /**
         * @return void
         */
        public function connect(): void 
        {
            try {
                $this->pdo = new PDO("mysql:host=db;dbname=todolist;charset=utf8", "root", "") ;
            } catch (PDOException $excepcion) {
                die("**Error: es imposible conectar con el motor de bases de datos.") ;
            }
        }

        /**
         * @param string $sql
         * @return void
         */
        public function prepare(string $sql): void 
        {
            $this->pdop = $this->pdo->prepare($sql) ; 
        }

        /**
         * @param array $params
         * @return void
         */
        public function query(array $params = []): void 
        {
            $this->pdop?->execute($params) ;
        }


    }