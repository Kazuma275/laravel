<?php

    namespace Database ;

    use PDO;
    use PDOException;
    use PDOStatement;

    class Database 
    {
        private static ?Database $instancia = null ;
        private ?PDO $pdo = null ;
        private ?PDOStatement $pdop = null ;

        private function __clone() { }
        private function __construct() 
        { 
            try {
                $this->pdo = new PDO("mysql:host=db;dbname=todolist;charset=utf8", "root", "") ;
            } catch (PDOException $excepcion) {
                die("**Error: es imposible conectar con el motor de bases de datos.") ;
            }
        }

        /**
         * Crea la instancia y la devuelve
         * @return Database|null
         */
        public static function init(): ?Database 
        {
            if (self::$instancia == null) self::$instancia = new Database ;
            return self::$instancia ;
        }

        /**         
         * Prepara una sentencia SQL
         * @param string $sql
         * @return Database
         */
        public function prepare(string $sql): Database
        {
            $this->pdop = $this->pdo->prepare($sql) ; 
            return $this ;
        }

        /** 
         * Ejecuta una sentencia ya preparada
         * @param array $params
         * @return Database
         */
        public function query(array $params = []): Database
        {
            #if (!is_null($this->pdop)) $this->pdop->execute($params) ;
            $this->pdop?->execute($params) ;
            return $this ;
        }

        /**
         * @param string $class
         * @return object|false
         */
        public function one(string $class = "StdClass"): object|false
        {
            return $this->pdop->fetchObject($class) ;
        }

        /**
         * Recupera y devuelve todos los registros obtenidos
         * en la consulta.
         * @param string $class
         * @return array
         */
        public function all(string $class = "StdClass"): array
        {
            return $this->pdop->fetchAll(PDO::FETCH_CLASS, $class) ;
        }

    }

   